import getCookie from './getcookies.js';
let note_title = document.getElementById("note-title");
const currentDate = new Date();
let note_content = document.getElementById("note-content");
const favoriteBtn = document.getElementById("favorite-btn");
const NewNoteButton = document.getElementById("new-note-btn");
const noteList = document.getElementById("note-lists");
const mainContent = document.getElementById("main-content");
const allNotes = document.getElementById("all-notes");
const saveButton = document.getElementById("save-button"); // work on using the saveButton
const NoteEdited = document.getElementById("note-edited");
const settingsButton = document.getElementById("settings-button");
const settings = document.getElementById("settings-up");
let newFlag = true; /// work on using the flag for new Notes;
let user_id = getCookie("user_id");
export {user_id};

let Showflag = true;

let favFlag = false;

settingsButton.addEventListener("click", function(){
    if(Showflag){
        settings.style.display="block";
        Showflag = false;
    }
    else{
        settings.style.display="none";
        Showflag = true;
    }

});


class Note {
    // Private variables to store the title and note content
    _note_id;
    _title;
    _note;
    _edit_time;
    _is_favourite;
    _is_garbage;

    constructor(){
        this._edit_time = currentDate.toISOString().slice(0, 19).replace('T', '');
        this._note_id = crypto.randomUUID();

    }

    get note_id(){
        return this._note_id;
    }

    set note_id(note_id){
        this._note_id = note_id;
    }



    // Getter for title
    get title() {
        return this._title;
    }

    // Setter for title
    set title(title) {
        this._title = title;
    }

    // Getter for note
    get note() {
        return this._note;
    }

    // Setter for note
    set note(note) {
        this._note = note;
    }

    get edit_time(){
        return this._edit_time;

    }

    set edit_time(edit_time){
        this._edit_time = edit_time;
    }
}


// work with the while loop for the NewNoteButton, that is a much better approach, and linkedLists for better navigation

let note = null;

NewNoteButton.addEventListener("click", function() {
    noteList.style.display = "none";
    mainContent.style.display = "flex";
    // Clear the input fields
    note_title.value = "";
    note_content.value = "";
    newFlag = true;
    // Create a new Note object and populate it with user input
    
});


saveButton.addEventListener("click", function(){
    note = new Note();
    note.title = note_title.value;
    note_title.dataset.noteId = note.note_id;
    note.note = note_content.value; // Assuming you have this in your class
    console.log(note_title.dataset.noteId);
    if(newFlag){
        fetch("dsp.php", {
            method: "POST",
            headers: {
                'Content-Type': "application/x-www-form-urlencoded"
            },
            body:
                "action=addPost" +
                "&note_id=" + encodeURIComponent(note.note_id) +
                "&note_title=" + encodeURIComponent(note.title) +
                "&note_content=" + encodeURIComponent(note.note) +
                "&note_created=" + encodeURIComponent(note.edit_time) + 
                "&user_id=" + user_id
        })
        .then(response => response.text())
        .then(data => console.log("Server response:", data))
        .catch(error => console.error("Error:", error));
        newFlag = false;
    }
    else {
        note.title = note_title.value;
        note.note = note_content.value;
        fetch("dsp.php", {
            method:"POST",
            headers:{
                'Content-Type':"application/x-www-form-urlencoded"
            },
            body:
                "action=updateNote" + 
                "&note_id=" + encodeURIComponent(note.note_id) +
                "&note_title=" + encodeURIComponent(note.title) + 
                "&note_content=" + encodeURIComponent(note.note) 


        })
        .then(response => response.text())
        .then(data => {
            console.log("server response", data);
            NoteEdited.innerText = "Edited: " + note.edit_time;

        })

    }
})

allNotes.addEventListener("click", function(){
    mainContent.style.display = "none";
    noteList.style.display = "flex";
})

note_title.addEventListener("change", function() {
    note.title = this.value; // Assign input value to the Note object's title
    console.log("Title", Note.title);
});

// Event listener for the content input field
note_content.addEventListener("input", function() {
    note.note = this.value; // Assign input value to the Note object's content
    console.log("Note : ", Note.note);
});

favoriteBtn.addEventListener("click", function(){
    favoriteBtn.style.backgroundColor = "yellow";
})