<?php
include './Classes/class-notes.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'addPost'){
    $note_title = $_POST['note_title'];
    $note_content = $_POST['note_content'];
    $note_create = $_POST['note_created'];
    $user_id = $_POST['user_id'];
    $note = new Notes($note_title, $note_content, $note_create, $user_id);
    if ($note->createNote()){
        echo "Note successfully created";


    }

}



?>