<?php   
        session_start();
        
        /*class dbconnection{
            $dbh = null;
            function __construct()
            {
                try{
                    $dbh = new PDO("mysql:host=localhost;dbname=slytube","Andrew","dvG2Ryyq8HCuv5B7");    
                }
                catch(PDOException $e){
                    echo $e->getMessage();
                }
            }
            
            public static function destroy()
            {
                $dbh = null;
            }
        }*/


        function connectDB()
        {
            $db = null;
            try{
                $db = new PDO("mysql:host=localhost;dbname=slytube","Andrew","dvG2Ryyq8HCuv5B7");    
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
            
            return $db;
        }

     function verify_one_checkbox($name)
    {
        $result = false;
        if(isset($_REQUEST["name"]))
        {
            if($_REQUEST["name"] == "on")
            {
                $result = true;
            }
        }
        return $result;
    }

     function getActiveUser($user_id)
       {
             $All_DB_connection = connectDB();
            $query = "select Login from users where ID = :user_id limit 1";
            $q = $All_DB_connection->prepare($query);
            $q->execute(array(":user_id" => $user_id));
            $row = $q->fetch();
            if(!$row)
            {
                return "Error";
            }
            else
            {
                return $row["Login"];
            }
            unset($All_DB_connection);
       }

    class user{
        public $username;
        public $password;
        public $email;
        public $avatar_path;
        private $user_id;
        private $is_authorized = false;
        
        public $DB;
        
        function __construct($u,$p,$e=null,$a=null)
        {
            $this->username = $u;
            $this->password = $p;
            $this->email = $e;
            $this->avatar_path = $a;
            $this->DB = connectDB();
        }
        
        public static function isAuthorized()
        {
            if (!empty($_SESSION["user_id"])) {
                return (bool) $_SESSION["user_id"];
            }
            return false;
        }

        public function passwordHash($password,$salt=null,$iterations = 10)
        {
            $salt || $salt = uniqid();
            $hash = md5(md5($password . md5(sha1($salt))));
            
            for($i = 0; $i < $iterations; $i++)
            {
                $hash = md5(md5(sha1($hash)));
            }
            return array('hash' => $hash, 'salt' => $salt);
        }
        
        
       public function getSalt($username)
       {
           $query = "select salt from users where Login = :username limit 1";
           $q = $this->DB->prepare($query);
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
        
        public function create($username,$password,$mail)
        {
            $user_exists = $this->getSalt($username);
            if($user_exists)
            {
                throw new \Exception("User exists: " . $username, 1);
            }
            
            $query = "insert into users(Login,Password,Mail,salt) values (:username, :password, :mail, :salt)";
            $hashes = $this->passwordHash($password);
            $q = $this->DB->prepare($query);
            try{
                $this->DB->beginTransaction();
                $result = $q->execute(array(
                ':username' => $username,
                ':password' => $hashes['hash'],
                ':mail' => $mail,
                ':salt' => $hashes['salt']
                ));
                $this->DB->commit();
                header('Location: index.php');
            }
            catch(\PDOException $e)
            {
                $this->DB->rollBack();
                echo "Database error:" . $e->getMessage();
                die();
            }
            
            if(!$result)
            {
                $info = $q->errorInfo();
                echo "DatabaseError" . $info[1] . $info[2];
                die();
            }
            
            return $result;
        }
        
        public function Authorization($username,$password,$remember = false)
        {
            $query = "select ID,Login from users where Login = :username and Password = :password limit 1";
            $q = $this->DB->prepare($query);
            $s = $this->getSalt($username);
            
            if($s != null)
            {
                $hashes = $this->passwordHash($password,$s);
                $q->execute(
                    array(
                        ":username" => $username,
                        ":password" => $hashes['hash']
                    )
                );
                
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
                    header("Location: index.php");
                }
            }

            return $this->is_authorized;
        }
        
        public static function logOut()
        {
            if(!empty($_SESSION["user_id"]))
            {
                unset($_SESSION["user_id"]);
                unset($_SESSION);
                session_destroy();
                header("Location: index.php");
            }
        }
        
        public function saveSession($remember = false,$http_only = true, $days = 7)
        {
            session_start();
            $_SESSION["user_id"] = $this->user_id;
            if($remember)
            {
                $sid = session_id();
                $time_to_save = time() + $days*24*3600;
                $dom = "";
                $secure = false;
                $path = "";
                $cookie = setcookie("sid",$sid,$time_to_save,$path,$dom,$secure,$http_only);
            }
        }
    }

    class video_worker{
        public static function checkFile($file)
        {
            $can_be_uploaded = false;
            $blacklist = array(".php","html",".php3",".php4",".htm",".mp3");
            foreach($blacklist as $item)
            {
                if(preg_match("/$item\$/i", $file['name'])) exit;
            }
            $filetype = $file['type'];
            $size = $file['size'];
            if($filetype == "video/mp4" && $size <= 104857600)
            {
                $can_be_uploaded = true;
            }
            return $can_be_uploaded;
        }
        
        public static function uploadFile($can_be_uploaded,$file,$name,$description)
        {
            $DB = connectDB();
            if($can_be_uploaded && !empty($name)){
                move_uploaded_file($file["tmp_name"],"videos/" .$file['name']);
                
                echo "Uploaded!";
            }
            else{
                if(empty($name))
                {
                    echo "Video name can't be empty!";
                }
                else
                    echo "File can not be Uploaded on server"; 
            }
        }
    }
?>
