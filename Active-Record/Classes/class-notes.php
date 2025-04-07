<?php
include 'class-dao.php';

class Notes{
    private $note_title;
    private $note_content;
    private $note_creation;
    private $note_edit_date;
    private $user_id;

    public function __construct($note_title, $note_content, $note_creation, $user_id)
    {
        $this->note_title = $note_title;
        $this->note_content = $note_content;
        $this->note_creation = $note_creation;
        $this->user_id = $user_id;

        
    }

    public function createNote() {
        // Get the database instance
        $pdo = DAO::getInstance();
    
        // Prepare the SQL query with the correct syntax
        $stmt = $pdo->prepare("INSERT INTO notes (note_title, note_content, note_created, user_id) VALUES (?, ?, ?, ?)");
    
    
        // Execute the statement with the class variables
        $stmt->execute([$this->note_title, $this->note_content, $this->note_creation, $this->user_id]);
    
        // Optionally, check if the query was successful
        if ($stmt->rowCount() > 0) {
            echo "Note created successfully.";
            return true;
        } else {
            echo "Failed to create note.";
            return false;
        }
    }
    


    public static function get_notes($user_id) {
        // Get the database instance
        $pdo = DAO::getInstance();
    
        // Prepare the SQL query to select notes for a specific user
        $stmt = $pdo->prepare("SELECT * FROM notes WHERE user_id = ?");
    
        // Execute the query with the user_id as a parameter
        $stmt->execute([$user_id]);
    
        // Fetch all the notes as an associative array
        $notes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        // Return the notes
        return $notes;
    }
    
    

}


?>  