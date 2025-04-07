let note_title = document.getElementById("note-title");
let note_content = document.getElementById("note-content");
const NewNoteButton = document.getElementById("new-note-btn");
const noteList = document.getElementById("note-lists");
const mainContent = document.getElementById("main-content");
const allNotes = document.getElementById("all-notes");
const saveButton = document.getElementById("save-button"); // work on using the saveButton
let newFlag = false; /// work on using the flag for new Notes;

function getCookie(name) {
    const value = `; ${document.cookie}`;  // add a semicolon for easier parsing
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) {
        return parts.pop().split(';').shift();
    }
    return null; // if not found
}


let user_id = getCookie("user_id");


class Note {
    // Private variables to store the title and note content
    _note_id;
    _title;
    _note;
    _create_time;
    _edit_time;
    _is_favourite;
    _is_garbage;

    constructor(){
        const currentDate = new Date();
        this._create_time = currentDate.toISOString().slice(0, 19).replace('T', '');

    }

    get note_id(){
        return this._note_id;
    }

    set note_id(note_id){
        this._note_id = note_id;
    }


    get create_time(){
        return this._create_time;
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


NewNoteButton.addEventListener("click", function() {
    noteList.style.display = "none";
    mainContent.style.display = "flex";
    let note = new Note();
    // Clear the input fields
    note_title.value = "";
    note_content.value = "";

    // Create a new Note object and populate it with user input
    note.title = note_title.value;
    note.note = note_content.value;
    note.create_time = new Date(); // Assuming you have this in your class

    // Send to server
    fetch("dsp.php", {
        method: "POST",
        headers: {
            'Content-Type': "application/x-www-form-urlencoded"
        },
        body:
            "action=addPost" +
            "&note_title=" + encodeURIComponent(note.title) +
            "&note_content=" + encodeURIComponent(note.note) +
            "&note_created=" + encodeURIComponent(note.create_time) + 
            "&user_id=" + user_id
    })
    .then(response => response.text())
    .then(data => console.log("Server response:", data))
    .catch(error => console.error("Error:", error));
});



allNotes.addEventListener("click", function(){
    mainContent.style.display = "none";
    noteList.style.display = "flex";
})


// Create a new Note object


// Event listener for the title input field
note_title.addEventListener("change", function() {
    Note.title = this.value; // Assign input value to the Note object's title
    console.log("Title", Note.title);
});

// Event listener for the content input field
note_content.addEventListener("input", function() {
    Note.note = this.value; // Assign input value to the Note object's content
    console.log("Note : ", Note.note);
});
