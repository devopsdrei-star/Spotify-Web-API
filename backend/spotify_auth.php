<?php
// backend/spotify_auth.php
// Handles Spotify OAuth and fetches song list

session_start();

$client_id = '';
$client_secret = '';
require_once __DIR__ . '/config.php';
$redirect_uri = 'http://127.0.0.1:3000/backend/callback.php'; // Update if needed
$scope = 'user-library-read playlist-read-private';

if (!isset($_GET['code'])) {
    $auth_url = 'https://accounts.spotify.com/authorize?'.http_build_query([
        'response_type' => 'code',
        'client_id' => $client_id,
        'scope' => $scope,
        'redirect_uri' => $redirect_uri,
    ]);
    header('Location: ' . $auth_url);
    exit();
} else {
    $code = $_GET['code'];
    $token_url = 'https://accounts.spotify.com/api/token';
    $response = file_get_contents($token_url, false, stream_context_create([
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
    ]));
    $token = json_decode($response, true);
    $_SESSION['access_token'] = $token['access_token'];
    // Do not auto-redirect, let callback.php show the access token page
    echo '<!DOCTYPE html><html><head><title>Spotify Access Token</title><style>body{font-family:sans-serif;background:#191414;color:#fff;text-align:center;padding-top:60px;}input{width:80%;padding:10px;font-size:1em;}button{margin-top:16px;padding:8px 18px;font-size:1em;background:#1db954;color:#fff;border:none;border-radius:6px;cursor:pointer;}button:hover{background:#17a74a;}</style></head><body>';
    echo '<h2>Spotify Access Token</h2>';
    echo '<input type="text" id="token" value="' . htmlspecialchars($token['access_token']) . '" readonly><br>';
    echo '<button onclick="navigator.clipboard.writeText(document.getElementById(\'token\').value)">Copy Token</button>';
    echo '<p style="margin-top:32px;">Use this token as a Bearer token in Postman.<br><a href="/public/index.html" style="color:#1db954;">Go to App</a></p>';
    echo '</body></html>';
    exit();
}
?>