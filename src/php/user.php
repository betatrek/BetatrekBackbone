<?php 

include 'db.php';

class User {
    private   $username = null;
    private   $password = null;
    private   $email = null;
    private   $fname = null;
    private   $lname = null;
    
    public function setUsername($username) {
        $this->username= $username;
    } 
    
    public function getUsername() {
        return $this->username;
    }
    
    public function setPassword($password) {
        $this->password = $password;
    } 
    
    public function getPassword() {
        return $this->password;
    }

    public function setEmail($email) {
        $this->email= $email;
    } 
    
    public function getEmail() {
        return $this->email;
    }

    /* Inser the user into the database. */
    public function insertUser() {
        $database = "betatrek";
        $mysql_conn = connect_mysql();
        connect_database($mysql_conn, $database);
        mysql_query("INSERT INTO User (username, password, email,fname,lname) 
                    VALUES($this->username, $this->password, $this->email, 
                    $this->fname, $this->lname)",$mysql_conn);
        mysql_close($mysql_conn);
    }
    
}

?>
