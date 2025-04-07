<?php
$path = session_save_path(); // Get session path
$files = glob($path . "/sess_*"); // All session files

foreach ($files as $file) {
    if (is_file($file)) {
        unlink($file); // Delete the file
    }
}

echo "✅ All session files deleted.";
?>