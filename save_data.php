<?php
$json = file_get_contents('php://input');
$obj = json_decode($json, true);

$data = $obj['filedata'];
$name = "data/{$obj['filename']}.csv";

header('Content-Type: application/json'); // Specify the content type as JSON

// write the file to disk
if (file_put_contents($name, $data, FILE_APPEND)) {
    // Send a JSON response with success status
    echo json_encode(array('success' => true, 'message' => 'Saved Successfully'));
} else {
    // Send a JSON response with an error status
    http_response_code(500); // Set a HTTP response code, e.g., 500 for server error
    echo json_encode(array('success' => false, 'message' => 'Unable to save the file.'));
}
?>
