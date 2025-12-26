<!-- Andrei
Leizel
Rodelyn -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spotify Song List</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
    // session_start();
    // if (isset($_SESSION['access_token'])) {
    //     echo '<div style="background:#1db954;color:#fff;padding:10px 0;border-radius:10px;margin-bottom:18px;font-size:1em;">Access Token: <span style="word-break:break-all;">' . htmlspecialchars($_SESSION['access_token']) . '</span></div>';
    // }
    ?>
    <div class="container">
        <h1>My Spotify Songs</h1>
        <button id="login-btn">Login with Spotify</button>
        <form id="search-form" style="margin: 24px 0;">
            <input type="text" id="search-input" placeholder="Search for a song, artist, or album..." style="padding: 10px; width: 70%; border-radius: 6px; border: none; font-size: 1em;">
            <button type="submit" style="padding: 10px 18px; border-radius: 6px; border: none; background: #1db954; color: #fff; font-size: 1em; cursor: pointer; margin-left: 8px;">Search</button>
        </form>
        <div id="song-list"></div>
    </div>
    <script src="js/app.js"></script>
    <!-- <script src="js/spotify_auth_url.js"></script> -->
    <footer style="margin-top:40px; text-align:center; color:#b3b3b3; font-size:0.98em;">
        Powered by Spotify Web API. This app is for educational purposes only.<br>
        &copy; 2025 ZAR. Spotify® is a registered trademark of Spotify AB.
    </footer>
</body>
</html>