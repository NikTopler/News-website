<?php 

class Session extends Dbh {

    public function setSession($email) {
        if(session_id() == '') session_start();
        
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
        $_SESSION['letter'] = strtoupper($email[0]);
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
    