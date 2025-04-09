<?php
include './Classes/class-notes.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'addPost'){
    $note_id = $_POST['note_id'];
    $note_title = $_POST['note_title'];
    $note_content = $_POST['note_content'];
    $note_create = $_POST['note_created'];
    $user_id = $_POST['user_id'];
    $note = new Notes($note_id, $note_title, $note_content, $note_create, $user_id);
    if ($note->createNote()){
        echo "Note successfully created";


    }
    exit;

}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'updateNote'){
    $note_id = $_POST['note_id'];
    $note_title = $_POST['note_title'];
    $note_content = $_POST['note_content'];
    Notes::updateNote($note_id, $note_title, $note_content);
    echo "Note update successfully";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && $_GET['action'] === "fetchPosts"){
    $user_id = isset($_GET['user_id']) ? $_GET['user_id'] : null;
    $notesArray = Notes::get_notes($user_id, false);
    header('Content-Type: application/json');
    echo $notesArray;
    exit;

}



?>