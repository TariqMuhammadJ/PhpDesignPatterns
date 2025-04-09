<?php
include 'class-dao.php';

class Notes{
    private $note_id;
    private $note_title;
    private $note_content;
    private $note_creation;
    private $note_edit_date;
    private $user_id;
    public static $totalNotes;

    public function __construct($note_id,$note_title, $note_content, $note_creation, $user_id)
    {   
        $this->note_id = $note_id;
        $this->note_title = $note_title;
        $this->note_content = $note_content;
        $this->note_creation = $note_creation;
        $this->user_id = $user_id;

        
    }

    public function createNote() {
        // Get the database instance
        $pdo = DAO::getInstance();
    
        // Prepare the SQL query with the correct syntax
        $stmt = $pdo->prepare("INSERT INTO notes (note_id, note_title, note_content, note_created, user_id) VALUES (?, ?, ?, ?, ?)");
    
    
        // Execute the statement with the class variables
        $stmt->execute([$this->note_id, $this->note_title, $this->note_content, $this->note_creation, $this->user_id]);
    
        // Optionally, check if the query was successful
        if ($stmt->rowCount() > 0) {
            echo "Note created successfully.";
            return true;
        } else {
            echo "Failed to create note.";
            return false;
        }
    }

    public static function updateNote($note_id, $note_title, $note_content){
        $pdo = DAO::getInstance();
            try{
                $sql = "UPDATE notes SET note_title = ?, note_content = ?, note_edited = NOW() WHERE note_id = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$note_title, $note_content, $note_id]);
                echo "note executed successfully";
    
            } catch (PDOException $e){
                echo "Error: " . $e->getMessage();
            }

    }


    public static function isFavourite($note_id,$isfavourite){
        $pdo = DAO::getInstance();
        if($isfavourite){
            try{
                $sql = "UPDATE notes SET isFavorite = 1 WHERE note_id = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$note_id]);
                echo "successfull";
            } catch (PDOException $e){
                echo "Error : " . $e->getMessage();
            }
        }
        else{
            try{
                $sql = "UPDATE notes SET isFavorite = 0 WHERE note_id = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$note_id]);
                echo "successfull";
            } catch (PDOException $e){
                echo "Error : " . $e->getMessage();
            }
        }
    }
    


    public static function get_notes($user_id, $isfavourite) {
        self::$totalNotes = 0;
        // Get the database instance
        $pdo = DAO::getInstance();
    
        // Prepare the SQL query to select notes for a specific user
        $stmt = $pdo->prepare("SELECT * FROM notes WHERE user_id = ?");
    
        // Execute the query with the user_id as a parameter
        $stmt->execute([$user_id]);
    
        // Fetch all the notes as an associative array
        $notes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        foreach ($notes as $note){
            self::$totalNotes += 1;
            echo '<li dataset-noteId="'.htmlspecialchars($note['note_id']) . '">';
            echo '<h1>' . $note['note_title'] . '</h1>';
            echo '<p>' . substr($note['note_content'], 0, 50) . '</p>';
            echo '<span class="note-date">'  . $note['note_edited'] . '</span>';
        }



    }
    
    

}




?>  