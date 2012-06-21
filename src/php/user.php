<?php 

include_once 'db.php';

class User {
    private $username = null;
    private $password = null;
    private $email = null;
    public $fname = null;
    public $lname = null;
    
   function __construct() {
        $this->username= "username";
        $this->password = "password";
        $this->email= "email";
        $this->fname= "fname";
        $this->lname= "lname";
    }

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
        $acc_db = "bt_user_accounts";
        $mysql_conn = connect_mysql();
        select_database($mysql_conn, $acc_db);

        $sql ="INSERT INTO Accounts (username, password, email, fname, lname) 
            VALUES('$this->username', '$this->password', '$this->email', '$this->fname', '$this->lname')";

        if(!mysql_query($sql,$mysql_conn))
        {
           print "Error inserting user\n";
        }
        mysql_close($mysql_conn);
    }
    
}

?>
