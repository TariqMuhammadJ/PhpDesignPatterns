import { user_id } from "./user_controller.js";

window.addEventListener("load", function() {
    const baseUrl = "http://localhost/DESIGNPATTERNS/Active-Record/dsp.php";
    const url = new URL(baseUrl);
    url.searchParams.append("action", "fetchPosts");
    url.searchParams.append("user_id", user_id);
    
    fetch(url, {
        method: "GET",
        headers: {
            'Content-Type': 'application/json', // Optional for GET, but keep it if you need it
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error("Network Error has occurred");
        }
        return response.json();  // Parse the response as JSON
    })
    .then(data => {
        // Log the JSON object to check its structure
        console.log("Parsed response:", data);

        // Loop over the data (assuming it's an object) and log key-value pairs
        const notesMap = jsonArray.reduce((map, note) =>{
            map.set()
        }) // learn maps and continue there
    })
    .catch(error => {
        console.error("There was a problem with the fetch:", error);
    });
});
