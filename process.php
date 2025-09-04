<?php
ob_start();

error_reporting(E_ALL);
ini_set('display_errors', 1); // enable errors for debugging

require_once 'config.php';

// Set headers
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Clear buffers
while (ob_get_level()) {
    ob_end_clean();
}

// Function to send JSON response
function send_json_response($status, $message) {
    echo json_encode([
        'status' => $status,
        'message' => $message
    ]);
    exit;
}

// Handle POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $message = $_POST['message'] ?? '';

    if (empty($name) || empty($email) || empty($message)) {
        send_json_response('error', 'All fields are required.');
    }

    try {
        global $db;
        $stmt = $db->prepare("INSERT INTO messages (name, email, message) VALUES (?, ?, ?)");
        $stmt->execute([$name, $email, $message]);

        send_json_response('success', 'Message Sent successfully!');
    } catch (Exception $e) {
        send_json_response('error', 'Database error: ' . $e->getMessage());
    }
} else {
    send_json_response('error', 'Invalid request method.');
}
