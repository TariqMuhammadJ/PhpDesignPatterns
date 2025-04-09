export default function getCookie(name) {
    const value = `; ${document.cookie}`;  // add a semicolon for easier parsing
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) {
        return parts.pop().split(';').shift();
    }
    return null; // if not found
}
