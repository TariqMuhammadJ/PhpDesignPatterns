let note_title = document.getElementById("note-title");
const currentDate = new Date();
let note_content = document.getElementById("note-content");
const NewNoteButton = document.getElementById("new-note-btn");
const noteList = document.getElementById("note-lists");
const mainContent = document.getElementById("main-content");
const allNotes = document.getElementById("all-notes");
const saveButton = document.getElementById("save-button"); // work on using the saveButton
const NoteEdited = document.getElementById("note-edited");
let newFlag = true; /// work on using the flag for new Notes;

function getCookie(name) {
    const value = `; ${document.cookie}`;  // add a semicolon for easier parsing
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) {
        return parts.pop().split(';').shift();
    }
    return null; // if not found
}


let user_id = getCookie("user_id");
export {user_id};


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
        this._create_time = currentDate.toISOString().slice(0, 19).replace('T', '');
        this._note_id = crypto.randomUUID();

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
    // Clear the input fields
    note_title.value = "";
    note_content.value = "";
    newFlag = true;
    // Create a new Note object and populate it with user input
    
});


saveButton.addEventListener("click", function(){
    let note = new Note();
    note.title = note_title.value;
    note_title.dataset.noteId = note.note_id;
    note.note = note_content.value;
    note.create_time = new Date(); // Assuming you have this in your class
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
                "&note_created=" + encodeURIComponent(note.create_time) + 
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
        note.edit_time = currentDate.toISOString().slice(0, 19).replace('T', ' ');
        fetch("dsp.php", {
            method:"PUT",
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
