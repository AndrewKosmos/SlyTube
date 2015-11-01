<?php
    namespace Auth;
    require ("connection.php");
    class User{
        private $id;
        private $username;
        private $email;
        private $avatar_path;
        private $user_id;
        
        private $is_authorized = false;
        
        public function __construct($username = null,$password = null,$email,$avatar_path = null)
        {
           $this->username = $username;
            $this->email = $email;
            $this->avatar_path = $avatar_path;
        }
        
        public function __destruct()
        {
            $this->db = null;
        }
        
        public static function isAuthorized()
        {
            if(!empty($_SESSION["user_id"]))
            {
                return (bool) $_SESSION["user_id"];
            }
            return false;
        }
        
        public function passwordHash($password,$salt = null,$iterations = 10)
        {
            $salt || $salt = uniqid();
            $hash = md5(md5($password . md5(sha1($salt))));
            for($i = 0; i < $iterations; ++$i)
            {
                $hash = md5(md5(sha1($hash)));
            }
            
            return array('hash' => $hash, 'salt' => $salt);
        }
        
        public function getSalt($username)
        {
            $query = "select salt from users where Login = :username limit 1";
            $q = $DB->prepare($query);
            $q->execute(array(":username" => $username));
            $row = $q->fetch();
            if(!$row)
            {
                return false;
            }
            else
            {
                return $row["salt"];
            }
        }
        
        public function authorize($username,$password,$remember = false)
        {
            $query = "select ID,Login from users where Login = :username and Password = :password limit 1";
            $q = $DB->prepare($query);
            $salt = $this->getSalt($username);
            
            if(!$salt)
            {
                return false;
            }
            
            $hashes = $this->passwordHash($password,$salt);
            
            $q->execute(array(":username" => $username, ":password" => $password));
            
            $this->user = $q->fetch();
            
            if(!$this->user)
            {
                $this->is_authorized = false;
            }
            else
            {
                $this->is_authorized = true;
                $this->user_id = $this->user['ID'];
                $this->saveSession($remember);
            }
            
            return $this->is_authorized;
        }
        
        public function logout()
        {
            if(!empty($_SESSION["user_id"]))
            {
                unset($_SESSION["user_id"]);
            }
        }
        
        public function saveSession($remember = false,$http_only = true, $days = 7)
        {
            $_SESSION["user_id"] = $this->user_id;
            if($remember)
            {
                $sid = session_id();
                $savetime = time() + $days * 24 * 3600;
                $domain = "";
                $secure = false;
                $path = "/";
                
                $cookie = setcookie("sid",$sid,$savetime,$path,$domain,$secure,$http_only);
            }
        }
    }

?>