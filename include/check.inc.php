<?php  include_once 'db.inc.php';

class Check extends Dbh {

    public function email($userInfo) {
        $sql = 'SELECT * FROM users WHERE email = ?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$userInfo[0]]);
        $row = $stmt->fetch();
        if(isset($_POST['email'])) {
            if($row) {
                if($row['password'] == null) {
                    if($row['googleID'] != null) echo "google user doesn't have password set up";
                    else if($row['facebookID'] != null) echo "facebook user doesn't have password set up";
                    else if($row['githubID'] != null) echo "github user doesn't have password set up";
                } else echo 'user exists';

            } else echo "user doesn't exist";
            return;
        }
    }
    public function login($userInfo) {
        if(!filter_var($userInfo[0], FILTER_VALIDATE_EMAIL)) {
            echo 'error email';
            return;
        }

        $sql = 'SELECT * FROM users WHERE email = ?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$userInfo[0]]);
        $row = $stmt->fetch();

        if(password_verify($userInfo[1], $row['password'])) {
            include_once 'session.inc.php';
            $session = new Session();
            $session->setSession($userInfo[0]);
            echo 'success';
        } else echo 'wrong password';
    }
}

$checkObj = new Check();

if($_SERVER['REQUEST_METHOD'] !== 'POST') return;
if(isset($_POST['email'])) $checkObj->email(json_decode($_POST['email']));
else if(isset($_POST['login'])) $checkObj->login(json_decode($_POST['login']));

