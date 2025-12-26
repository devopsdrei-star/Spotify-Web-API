<?php
// backend/spotify_search.php
// Search for tracks on Spotify using the Web API

session_start();

if (!isset($_SESSION['access_token'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Not authenticated']);
    exit();
}

if (!isset($_GET['q'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing search query']);
    exit();
}

$access_token = $_SESSION['access_token'];
$query = urlencode($_GET['q']);
$type = 'track';
$url = "https://api.spotify.com/v1/search?q=$query&type=$type&limit=20";

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