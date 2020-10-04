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
    public function pswSet() {
        if (session_status() == PHP_SESSION_NONE) session_start();
        $string = '';
        if($_SESSION['password-set'] != 'Not set') {
            $string = '<div class="psw-old-container">
                            <div class="input-container">
                                <div class="label-container">
                                    <label for="psw-old-input">Old Password</label>
                                </div>
                                <input type="password" name="password" id="psw-old-input" autocomplete="off">
                            </div>
                            <div class="eye-icon-container" onclick="managePasswordVisibility(this)">
                                <div>
                                    <i class="far fa-eye fa-lg disable"></i>
                                    <i class="far fa-eye-slash fa-lg"></i>
                                </div>
                            </div>
                        </div>';
        }
        echo $string.'<div class="psw-container">
                        <div class="input-container">
                            <div class="label-container">
                                <label for="psw-input">New Password</label>
                            </div>
                            <input type="password" name="password" id="psw-input" autocomplete="off">
                        </div>
                        <div class="eye-icon-container" onclick="managePasswordVisibility(this)">
                            <div>
                                <i class="far fa-eye fa-lg disable"></i>
                                <i class="far fa-eye-slash fa-lg"></i>
                            </div>
                        </div>
                    </div>
                    <div class="psw-repeat-container">
                        <div class="input-container">
                            <div class="label-container">
                                <label for="psw-repeat-input">Repeat</label>
                            </div>
                            <input type="password" name="password-repeat" id="psw-repeat-input" autocomplete="off">
                        </div>
                        <div class="eye-icon-container" onclick="managePasswordVisibility(this)">
                            <div>
                                <i class="far fa-eye fa-lg disable"></i>
                                <i class="far fa-eye-slash fa-lg"></i>
                            </div>
                        </div>
                    </div>
                    <div class="error psw disable">
                    <div class="red"></div>
                    </div>
                    <div class="button-container">
                        <div class="inner-container">
                            <a href="personal.php">Back</a>
                        </div>
                        <div class="inner-container">
                            <div class="blue-button" onclick="check.psw()">Next</div>
                        </div>
                    </div>';
        die;
    }
}

$checkObj = new Check();

if($_SERVER['REQUEST_METHOD'] !== 'POST') return;
if(isset($_POST['email'])) $checkObj->email(json_decode($_POST['email']));
else if(isset($_POST['login'])) $checkObj->login(json_decode($_POST['login']));
else if(isset($_POST['pswSet'])) $checkObj->pswSet();
