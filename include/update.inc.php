<?php  include_once 'db.inc.php';
if (session_status() == PHP_SESSION_NONE) session_start();


class update extends Dbh {

    public function name($userInfo) {

        if(empty($userInfo[0]) || empty($userInfo[1])) {
            echo 'empty';
            die;
        }
        $sql = 'UPDATE users SET name = ? WHERE email = ?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$userInfo[0], $_SESSION['email']]);

        $sql = 'UPDATE users SET surname = ? WHERE email = ?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$userInfo[1], $_SESSION['email']]);
        $this->setSessionVariables($_SESSION['email']);
        echo 'success';
    }
    public function gender($userInfo) {
        $sql = 'UPDATE users SET gender = ? WHERE email = ?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$userInfo[0], $_SESSION['email']]);
        $this->setSessionVariables($_SESSION['email']);
        echo 'success';
    }
    public function country($userInfo) {
        $sql = 'UPDATE users SET country_id = (SELECT id FROM countries WHERE name = ?) WHERE email = ?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$userInfo[0], $_SESSION['email']]);
        $this->setSessionVariables($_SESSION['email']);
        echo 'success';
    }

    public function setSessionVariables($email) {
        include_once 'session.inc.php';
        $session = new Session();
        $session->setSession($email);
    }
    public function newPsw($userInfo) {
        $this->checkPsw($userInfo);
        $sql = 'UPDATE users SET password = ? WHERE email = ?';
        $hashPsw = password_hash($userInfo[0], PASSWORD_DEFAULT);
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$hashPsw, $_SESSION['email']]);
        $this->setSessionVariables($_SESSION['email']);
        echo 'success';
    }
    public function updatePswChangeTime() {
        $sql = 'UPDATE users SET password_change = ? WHERE email = ?';
        $d1 = new Datetime();
        $d2 = $d1->format('U');
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$d2, $_SESSION['email']]);
    }
    public function checkPsw($userInfo) {
        if((empty($userInfo[0]) || empty($userInfo[1]) || ($userInfo[0] != $userInfo[1]) || $userInfo[0]) > 20) {
            if(empty($userInfo[0]) || empty($userInfo[1])) echo 'empty';
            else if($userInfo[0] != $userInfo[1]) echo 'do not match';
            else if(strlen($userInfo[0]) > 20) echo 'password too long';
            die;
        }
    }

    public function oldPsw($userInfo) {
        $this->checkPsw([$userInfo[1], $userInfo[2]]);
        if(empty($userInfo[0])) {
            echo 'empty';
            die;
        } else if(strlen($userInfo[0]) < 6) {
            echo 'too short';
            die;
        }
        if($this->ifPswIsCorrect($userInfo[0]) == 'wrong password') {
            echo 'wrong password';
            die;
        }
        $sql = 'UPDATE users SET password = ? WHERE email = ?';
        $hashPsw = password_hash($userInfo[1], PASSWORD_DEFAULT);
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$hashPsw, $_SESSION['email']]);
        $this->updatePswChangeTime();
        echo 'success';
    }
    public function ifPswIsCorrect($psw) {

        $sql = 'SELECT * FROM users WHERE email = ?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$_SESSION['email']]);
        $row = $stmt->fetch();

        if(password_verify($psw, $row['password'])) {
            $this->setSessionVariables($_SESSION['email']);
            return 'success';
        } else return 'wrong password';
    }

    public function addAdmin($email) {
        if($this->checkIfUserExists($email) == 0) die;
        $sql = "INSERT INTO admins(user_id) VALUES((SELECT id FROM users WHERE email = ?))";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$email]);
        echo 'success';
    }

    public function checkIfUserExists($email) {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$email]);
        $row = $stmt->fetch();
        if($row) return 1;
        else return 0;
    }

    public function removeAdmin($email) {
        if($this->checkIfUserExists($email) == 0) die;
        $sql = "DELETE FROM admins WHERE user_id = (SELECT id FROM users WHERE email = ?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$email]);
        echo 'success';
    }

    public function imageUpload($info) {
        if($info[0] == '0') {
            $name = "profile_img";
            $num = 0;
        }
        $this->checkForImage();
        $sql = "UPDATE users SET profile_choice = ? WHERE email = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$num, $_SESSION['email']]);

        $sql = "UPDATE users SET ".$name." = ? WHERE email = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$info[1], $_SESSION['email']]);
        $this->setSessionVariables($_SESSION['email']);
        echo 'success';
    }
    public function checkForImage() {
        $sql = 'SELECT * FROM users WHERE email = ?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$_SESSION['email']]);
        $row = $stmt->fetch();
        if($row['profile_select'] == 0 && $row['profile_img'] != null) unlink('../'.$row['profile_img']);
    }
}

$updateObj = new Update();

if($_SERVER['REQUEST_METHOD'] !== 'POST') return;
else if(isset($_POST['name'])) $updateObj->name(json_decode($_POST['name']));
else if(isset($_POST['gender'])) $updateObj->gender(json_decode($_POST['gender']));
else if(isset($_POST['country'])) $updateObj->country(json_decode($_POST['country']));
else if(isset($_POST['newPsw'])) $updateObj->newPsw(json_decode($_POST['newPsw']));
else if(isset($_POST['oldPsw'])) $updateObj->oldPsw(json_decode($_POST['oldPsw']));
else if(isset($_POST['addAdmin'])) $updateObj->addAdmin($_POST['addAdmin']);
else if(isset($_POST['removeAdmin'])) $updateObj->removeAdmin($_POST['removeAdmin']);
else if(isset($_POST['imageUpload'])) $updateObj->imageUpload(json_decode($_POST['imageUpload']));

