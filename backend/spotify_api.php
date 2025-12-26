<?php
// backend/spotify_api.php
// Fetches user's saved tracks from Spotify Web API


session_start();

// Try to get access token from Authorization header
$access_token = null;
if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
    if (preg_match('/Bearer\s(\S+)/', $_SERVER['HTTP_AUTHORIZATION'], $matches)) {
        $access_token = $matches[1];
    }
}
// Fallback to session if not provided in header
if (!$access_token && isset($_SESSION['access_token'])) {
    $access_token = $_SESSION['access_token'];
}
if (!$access_token) {
    http_response_code(401);
    echo json_encode(['error' => 'Not authenticated']);
    exit();
}

$url = 'https://api.spotify.com/v1/me/tracks?limit=20';

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