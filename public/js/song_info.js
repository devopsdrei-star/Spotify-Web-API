// public/js/song_info.js
function getQueryParam(name) {
    const url = new URL(window.location.href);
    return url.searchParams.get(name);
}

const songId = getQueryParam('id');
const infoDiv = document.getElementById('song-info');

if (!songId) {
    infoDiv.textContent = 'No song ID provided.';
} else {
    fetch(`../backend/spotify_track.php?id=${encodeURIComponent(songId)}`)
        .then(res => res.json())
        .then(data => {
            if (data.error) {
                infoDiv.textContent = 'Error: ' + (data.error.message || data.error);
                return;
            }
            infoDiv.innerHTML = `
                <img class="song-info-img" src="${data.album.images[0]?.url || ''}" alt="Album Art">
                <div class="song-info-title">${data.name}</div>
                <div class="song-info-artist">${data.artists.map(a => a.name).join(', ')}</div>
                <div class="song-info-album">Album: ${data.album.name}</div>
                <div class="song-info-release">Release Date: ${data.album.release_date}</div>
                <div>Duration: ${(data.duration_ms/60000).toFixed(2)} min</div>
                <div class="song-info-preview">
                    ${data.preview_url ? `<audio controls src="${data.preview_url}">Your browser does not support the audio element.</audio>` : '<em>No preview available.</em>'}
                </div>
                <a class="back-link" href="index.php">← Back to Search</a>
            `;
        })
        .catch(() => {
            infoDiv.textContent = 'Error fetching song info.';
        });
}
