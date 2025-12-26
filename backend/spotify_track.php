<?php
// backend/spotify_track.php
// Fetches details for a specific track from Spotify Web API

session_start();

if (!isset($_SESSION['access_token'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Not authenticated']);
    exit();
}

if (!isset($_GET['id'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing track id']);
    exit();
}

$access_token = $_SESSION['access_token'];
$track_id = $_GET['id'];
$url = "https://api.spotify.com/v1/tracks/$track_id";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer ' . $access_token
]);
$response = curl_exec($ch);
curl_close($ch);

header('Content-Type: application/json');
echo $response;
?>