<?php  include_once 'db.inc.php';

class Login extends Dbh {

    public function google($userInfo) {
        require_once '../vendor/autoload.php';
        $client = new Google_Client(['client_id' => $userInfo[2]]);
        $payload = $client->verifyIdToken($userInfo[1]);
        if (!$payload) {
            echo 'error';
            return;
        } 

        $userExist = $this->checkIfUserExists('google', $userInfo);
        if($userExist == 'empty') $this->insert('google', $userInfo);
        else if($userExist == 'ID') $this->updateID('googleID', $userInfo);
        $this->setSessionVariables($userInfo[6]);
        echo 'success';
    }
    public function facebook($userInfo) {
        $userExist = $this->checkIfUserExists('facebook', $userInfo);
        if($userExist == 'empty') $this->insert('facebook', $userInfo);
        else if($userExist == 'ID') $this->updateID('facebookID', $userInfo);
        $this->setSessionVariables($userInfo[6]);
        echo 'success';
    }

    public function checkIfUserExists($type, $userInfo) {
        
        $sql = 'SELECT * FROM users WHERE email = ?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$userInfo[6]]);
        $row = $stmt->fetch();

        if($type == 'google') $dbName = 'googleID';
        else if($type == 'facebook') $dbName = 'facebookID';

        if(!$row) return 'empty';
        else if(password_verify($userInfo[0], $row[$dbName])) return 'full';
        else return 'ID';
    }
    public function insert($type, $userInfo) {
        if($type == 'google') {
            $num = 2;
            $sql = 'INSERT INTO users(name, surname, email, google_profile_img, googleID) VALUES(?, ?, ?, ?, ?)';
            $hashGoogleID = password_hash($userInfo[0], PASSWORD_DEFAULT);
            $array = [$userInfo[3], $userInfo[4], $userInfo[6], $userInfo[5], $hashGoogleID];
        } else if ($type == 'facebook') {
            $num = 3;
            $sql = 'INSERT INTO users(name, surname, email, facebook_profile_img, facebookID) VALUES(?, ?, ?, ?, ?)';
            $hashFacebookID = password_hash($userInfo[0], PASSWORD_DEFAULT);
            $array = [$userInfo[3], $userInfo[4], $userInfo[6], $userInfo[5], $hashFacebookID];
        }
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute($array);

        $this->updateProfileChoice($num, $userInfo[6]);
    }
    public function updateID($type, $userInfo) {
        if($this->isIdSet($type, $userInfo) == 1) {
            $hashID = password_hash($userInfo[0], PASSWORD_DEFAULT);
            $sql = 'UPDATE users SET '.$type.'= ? WHERE email = ?';
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$hashID, $userInfo[6]]);
        }
        if($type == 'googleID') $var = 'google_profile_img';
        else if($type == 'facebookID') $var = 'facebook_profile_img';

        $sql = 'UPDATE users SET '.$var.' = ? WHERE email = ?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$userInfo[5], $userInfo[6]]);
    } 
    public function isIdSet($type, $userInfo) {

        $sql = 'SELECT * FROM users WHERE email = ?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$userInfo[6]]);
        $row = $stmt->fetch();

        return empty($row[$type]);
    }
    public function updateProfileChoice($num, $email) {
        $sql = 'UPDATE users SET profile_choice = ? WHERE email = ?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$num, $email]);
    }
    public function setSessionVariables($email) {
        session_start();

        $sql = 'SELECT * FROM users WHERE email = ?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$email]);
        $row = $stmt->fetch();

        $_SESSION['id'] = $row['id'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['surname'] = $row['surname'];
        $_SESSION['email'] = $email;
        $_SESSION['gender'] = $row['gender'];
        $_SESSION['password_change'] = $row['password_change'];
        $_SESSION['profile_img'] = $row['profile_img'];
        $_SESSION['profile_color'] = $row['profile_color'];
        $_SESSION['google_profile_img'] = $row['google_profile_img'];
        $_SESSION['facebook_profile_img'] = $row['facebook_profile_img'];
        $_SESSION['github_profile_img'] = $row['github_profile_img'];
        $_SESSION['profile_choice'] = $row['profile_choice'];
        $_SESSION['googleID'] = $this->checkIfStringNull($row['googleID']);
        $_SESSION['facebookID'] = $this->checkIfStringNull($row['facebookID']);
        $_SESSION['githubID'] = $this->checkIfStringNull($row['githubID']);
        $_SESSION['country'] = $this->getCountryWithID($row['country_id']);
    }

    public function checkIfStringNull($string) { 
        if($string == null) return 0;
        else return 1;
    }
    public function getCountryWithID($countryID) {
        $sql = 'SELECT * FROM countries WHERE id = ?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$countryID]);
        $row = $stmt->fetch();
        $country = array($row['name'], $row['acronym']);
        return $country;
    }
}

$loginObj = new Login();

if($_SERVER['REQUEST_METHOD'] !== 'POST') return;
else if(isset($_POST['google'])) $loginObj->google(json_decode($_POST['google']));
else if(isset($_POST['facebook'])) $loginObj->facebook(json_decode($_POST['facebook']));
