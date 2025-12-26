<?php
// backend/callback.php
// Handles Spotify OAuth callback and stores access token in session

session_start();

$client_id = '2b0fb83d84044cc499d3f2e40c41bbde';
$client_secret = '160af5d1b02a44d8b3ea45a1275a69e1';
$redirect_uri = 'http://127.0.0.1:3000/backend/callback.php'; // Updated to match Spotify app settings

if (!isset($_GET['code'])) {
    echo 'No code provided.';
    exit();
}

$code = $_GET['code'];
$token_url = 'https://accounts.spotify.com/api/token';

$options = [
    'http' => [
        'method' => 'POST',
        'header' => "Content-type: application/x-www-form-urlencoded",
        'content' => http_build_query([
            'grant_type' => 'authorization_code',
            'code' => $code,
            'redirect_uri' => $redirect_uri,
            'client_id' => $client_id,
            'client_secret' => $client_secret,
        ]),
    ]
];

$response = file_get_contents($token_url, false, stream_context_create($options));
$token = json_decode($response, true);

if (isset($token['access_token'])) {
    $_SESSION['access_token'] = $token['access_token'];
    echo '<script>console.log("Spotify Access Token: ' . addslashes($token['access_token']) . '");</script>';
    header('Location: /public/index.html');
    exit();
} else {
    echo 'Failed to get access token.';
    exit();
}
?>