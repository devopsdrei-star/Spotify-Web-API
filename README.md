# Spotify API Web App

A simple web application that allows users to search for songs, view their saved tracks, and see song details using the Spotify Web API.

## Features
- Spotify OAuth 2.0 authentication
- Search for songs, artists, or albums
- View your saved tracks
- See detailed song info (album, artist, preview, etc.)
- Responsive design
- Error handling and input validation

## Setup Instructions

1. **Clone the repository:**
   ```
   git clone https://github.com/yourusername/spotify_api.git
   cd spotify_api
   ```

2. **Install PHP (if not installed):**
   - Required for backend scripts.

3. **Register your app on the [Spotify Developer Dashboard](https://developer.spotify.com/dashboard/)**
   - Get your `Client ID` and `Client Secret`.

4. **Configure your credentials:**
   - Copy `backend/config.php.example` to `backend/config.php` (or create manually).
   - Add your Spotify credentials:
     ```php
     $client_id = 'YOUR_CLIENT_ID_HERE';
     $client_secret = 'YOUR_CLIENT_SECRET_HERE';
     ```

5. **Start the PHP server:**
   ```
   php -S http://127.0.0.1:3000 -t public
   ```

6. **Open the app:**
   - Go to [http://127.0.0.1:3000](http://127.0.0.1:3000) in your browser.

## Security Notes
- **Never commit your real `config.php` or secrets to GitHub!**
- `.gitignore` is set up to exclude sensitive files.

## API Endpoints
- `/backend/spotify_api.php` — Get saved tracks
- `/backend/spotify_search.php?q=QUERY` — Search for tracks
- `/backend/spotify_track.php?id=TRACK_ID` — Get track details

## Postman Testing
- See `postman_api_testing_script.txt` for sample requests and error handling.

## Credits
- Powered by the [Spotify Web API](https://developer.spotify.com/documentation/web-api/)
- UI inspired by Spotify branding

---
For educational purposes only. Not affiliated with Spotify AB.
