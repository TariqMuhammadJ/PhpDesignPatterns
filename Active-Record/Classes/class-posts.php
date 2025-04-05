<?php
include 'class-dao.php';

class Posts{
    private $user_id;
    private $title;
    private $content;
    private $file = 'logger.txt';

    public function __construct($user_id, $title, $content){ // use the args[] array as a parameter
        $this->user_id = $user_id;
        $this->title = $title;
        $this->content = $content;
    }

    public function create_post($title, $content) {
        // Get the PDO instance
        $pdo = DAO::getInstance();
        
        // Prepare the SQL statement with placeholders
        $stmt = $pdo->prepare("INSERT INTO `posts` (`post_title`, `post_content`, `post_date`) VALUES (?, ?, NOW())");
        
        // Bind the parameters to the placeholders
        $stmt->execute([$title, $content]);
        
        // Check if the insert was successful
        if ($stmt->rowCount() > 0) {
            echo "Post created successfully!";
        } else {
            echo "Error creating post.";
        }
    }

    public static function get_posts($user_id){
        $pdo = DAO::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM posts where user_id = ?");
        $stmt->execute([$user_id]);
        

    }
    

}


?>  