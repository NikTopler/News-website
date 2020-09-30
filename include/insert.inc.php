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
            $color = $this->randomColor();
            $num = 1;
            $emailNum = 2;
            $countryID = $this->getCountryIDwithName($userInfo[5]);
            $hashPassword = password_hash($userInfo[3], PASSWORD_DEFAULT);
            $sql = 'INSERT INTO users(name, surname, email, password, country_id, profile_color) VALUES(?, ?, ?, ?, ?, ?)';
            $array = [$userInfo[0], $userInfo[1], $userInfo[2], $hashPassword, $countryID, $color];
        }
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute($array);
        $this->updateProfileChoice($num, $userInfo[$emailNum]);
        $this->setSessionVariables($userInfo[$emailNum]);
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
        $this->checkIfUserExists($userInfo[2]);
        $this->errorHandeling($userInfo);
        $this->insert('standard', $userInfo);
        echo 'success';
    }
    public function checkIfUserExists($email) {
        $sql = 'SELECT * FROM users WHERE email = ?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$email]);
        $row = $stmt->fetch();
        if($row) {            
            if($row['googleID'] != null) $this->errorHandeling("exist google");
            if($row['facebookID'] != null) $this->errorHandeling("exist facebook");
            if($row['githubID'] != null)  $this->errorHandeling("exist github");
            $this->errorHandeling("user exist's");
        } 
    }
    public function errorOver($string) {
        echo $string;
        die;
    }
    public function errorHandeling($userInfo) {
        $string = 'empty';
        if(empty($userInfo[0])) $string = $string.' name';
        if(empty($userInfo[1])) $string = $string.' surname';
        if(empty($userInfo[2])) $string = $string.' email';
        if(empty($userInfo[3])) $string = $string.' password';
        if(empty($userInfo[4])) $string = $string.' password-repeat';
        if($userInfo[5] == 'Select Country') $string = $string.' country';
        if($string != 'empty') $this->errorOver($string);

        if(strlen($userInfo[0]) > 10) $this->errorOver('name too long');
        if(strlen($userInfo[1]) > 10) $this->errorOver('surname too long');

        if(!filter_var($userInfo[2], FILTER_VALIDATE_EMAIL)) $this->errorOver('incorrect email');

        if($userInfo[3] != $userInfo[4]) $this->errorOver("passwords don't match");
        if(strlen($userInfo[3]) > 25) $this->errorOver('password too long');
        if(preg_match('/\s/', $userInfo[3])) $this->errorOver("no white spaces in password");
    }
    public function randomColor() {
        $colors = array('rgb(211,47,47)','rgb(123,31,162)','rgb(81,45,168)','rgb(48,63,159)','rgb(25,118,210)','rgb(2,136,209)','rgb(0,151,167)','rgb(0,121,107)','rgb(56,142,60)','rgb(104,159,56)','rgb(175,180,43)','rgb(251,192,45)','rgb(255,160,0)','rgb(245,124,0)','rgb(230,74,25)','rgb(93,64,55)','rgb(97,97,97)');
        $i = array_rand($colors);
        return $colors[$i];
    }
}

$loginObj = new Login();

if($_SERVER['REQUEST_METHOD'] !== 'POST') return;
else if(isset($_POST['google'])) $loginObj->google(json_decode($_POST['google']));
else if(isset($_POST['facebook'])) $loginObj->facebook(json_decode($_POST['facebook']));
else if(isset($_POST['standard'])) $loginObj->standard(json_decode($_POST['standard']));