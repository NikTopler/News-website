<?php  include_once 'db.inc.php';

class Login extends Dbh{

    public function google($userInfo) {
        require_once '../vendor/autoload.php';
        $client = new Google_Client(['client_id' => $userInfo[2]]);
        $payload = $client->verifyIdToken($userInfo[1]);
        if (!$payload) {
            echo 'error';
            return;
        } 

        $userExist = $this->checkIfUserExistsExternal('google', $userInfo);
        if($userExist == 'empty') $this->insert('google', $userInfo);
        else if($userExist == 'ID') $this->updateID('googleID', $userInfo);
        $this->setSessionVariables($userInfo[6]);
        echo 'success';
    }
    public function facebook($userInfo) {
        $userExist = $this->checkIfUserExistsExternal('facebook', $userInfo);
        if($userExist == 'empty') $this->insert('facebook', $userInfo);
        else if($userExist == 'ID') $this->updateID('facebookID', $userInfo);
        $this->setSessionVariables($userInfo[6]);
        echo 'success';
    }

    public function checkIfUserExistsExternal($type, $userInfo) {
        
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
            $emailNum = 6;
            $sql = 'INSERT INTO users(name, surname, email, google_profile_img, googleID) VALUES(?, ?, ?, ?, ?)';
            $hashGoogleID = password_hash($userInfo[0], PASSWORD_DEFAULT);
            $array = [$userInfo[3], $userInfo[4], $userInfo[6], $userInfo[5], $hashGoogleID];
        } else if ($type == 'facebook') {
            $num = 3;
            $emailNum = 6;
            $sql = 'INSERT INTO users(name, surname, email, facebook_profile_img, facebookID) VALUES(?, ?, ?, ?, ?)';
            $hashFacebookID = password_hash($userInfo[0], PASSWORD_DEFAULT);
            $array = [$userInfo[3], $userInfo[4], $userInfo[6], $userInfo[5], $hashFacebookID];
        } else if($type === 'standard') {
            $num = 1;
            $emailNum = 2;
            $countryID = $this->getCountryIDwithName($userInfo[5]);
            $hashPassword = password_hash($userInfo[3], PASSWORD_DEFAULT);
            $sql = 'INSERT INTO users(name, surname, email, password, country_id) VALUES(?, ?, ?, ?, ?)';
            $array = [$userInfo[0], $userInfo[1], $userInfo[2], $hashPassword, $countryID];
        }
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute($array);
        $this->updateProfileChoice($num, $userInfo[$emailNum]);
        $this->setSessionVariables($userInfo[$emailNum]);
        echo 'success';
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
        include_once 'session.inc.php';
        $session = new Session();
        $session->setSession($email);
    }
    public function getCountryIDwithName($country) {
        $sql = 'SELECT * FROM countries WHERE name = ?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$country]);
        $row = $stmt->fetch();
        $countryID = $row['id'];
        return $countryID;
    }

    public function standard($userInfo) {
        $res = $this->checkIfUserExists($userInfo[2]);
        if($res == "user exist's") {
            echo "user exist's";
            return;
        } else if($res == "exist google" ||  $res == "exist facebook" || $res == "exist github") {
            echo $res;
            return;
        }
        if(!filter_var($userInfo[2], FILTER_VALIDATE_EMAIL)) {
            echo 'incorrect email';
            return;
        }
        if($userInfo[3] !== $userInfo[4]) {
            echo "passwords don't match";
            return;
        }
        $this->insert('standard', $userInfo);
    }
    public function checkIfUserExists($email) {
        $sql = 'SELECT * FROM users WHERE email = ?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$email]);
        $row = $stmt->fetch();
        if($row) {            
            if($row['googleID'] != null) return "exist google";
            if($row['facebookID'] != null) return "exist facebook";
            if($row['githubID'] != null) return "exist github";
            return "user exist's";
        } 
        else return "user doesn't exist's";  
    }
}

$loginObj = new Login();

if($_SERVER['REQUEST_METHOD'] !== 'POST') return;
else if(isset($_POST['google'])) $loginObj->google(json_decode($_POST['google']));
else if(isset($_POST['facebook'])) $loginObj->facebook(json_decode($_POST['facebook']));
else if(isset($_POST['standard'])) $loginObj->standard(json_decode($_POST['standard']));