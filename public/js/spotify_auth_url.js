// public/js/spotify_auth_url.js
const clientId = "2b0fb83d84044cc499d3f2e40c41bbde";
const redirectUri = "http://127.0.0.1:3000/backend/callback.php";
const scopes = "user-read-currently-playing user-top-read user-library-read playlist-read-private";

const authUrl = `https://accounts.spotify.com/authorize?client_id=${clientId}&response_type=code&redirect_uri=${encodeURIComponent(redirectUri)}&scope=${encodeURIComponent(scopes)}`;
console.log(authUrl);

document.addEventListener('DOMContentLoaded', function() {
    const btn = document.createElement('button');
    btn.textContent = 'Login with Spotify (JS)';
    btn.onclick = () => {
        window.location.href = authUrl;
    };
    document.body.appendChild(btn);
});
