<?php
class DAO {
    protected static $host = 'localhost';
    protected static $db = 'test';
    protected static $user = 'root';
    protected static $pass = '';
    protected static $charset = 'utf8mb4';
    private static $instance = null;
    private static $file = 'logger.txt';

    private function __construct() {
        // Prevent direct construction
    }

    public function __clone(){}
    public function __wakeup(){}

    public static function getInstance() {
        if (self::$instance === null) {
            $dsn = "mysql:host=" . self::$host . ";dbname=" . self::$db . ";charset=" . self::$charset;
            try {
                self::$instance = new PDO($dsn, self::$user, self::$pass);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Connection failed: " . $e->getMessage());
            }
        }
        return self::$instance;
    }

    public static function getLoginBy($username, $pass){
        $pdo = self::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM users where username = ? AND password = ?");
        $stmt->execute([$username, $pass]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user){
            return $user;
            $message = "User " . $user['username'] . "has successfully logged in" . "" . $user["login_time"];

            file_put_contents(self::$file, $message);

        }
        $message = "An error with a login attemp";
        file_put_contents(self::$file, $message );
        return false;
    }

    public static function createPost($user_id, $title, $post_content){
        $pdo = self::getInstance();
    }
}

?>