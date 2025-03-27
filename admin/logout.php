<?php
session_start();

// Regenerate session ID before destroying to prevent session fixation attacks
session_regenerate_id(true);

// Unset all session variables securely
$_SESSION = [];

// Delete the session cookie if it exists
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Destroy the session
session_destroy();

// Prevent browser caching to avoid back-navigation issues
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");

// Ensure safe redirection with proper HTTP headers
header("Location: ../"); // Use explicit path for clarity
exit();
?>
