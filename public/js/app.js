document.addEventListener('DOMContentLoaded', function() {
    const loginBtn = document.getElementById('login-btn');
    const songList = document.getElementById('song-list');
    const searchForm = document.getElementById('search-form');
    const searchInput = document.getElementById('search-input');

    // Check if already authenticated (session)
    fetch('../backend/spotify_api.php')
        .then(res => {
            if (res.status === 401) {
                loginBtn.style.display = 'inline-block';
            } else {
                loginBtn.style.display = 'none';
                return res.json();
            }
        })
        .then(data => {
            if (data && data.items) {
                renderSongs(data.items.map(item => item.track));
            }
        });

    loginBtn.addEventListener('click', function() {
        window.location.href = '../backend/spotify_auth.php';
    });

    if (searchForm) {
        searchForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const query = searchInput.value.trim();
            if (!query) return;
            songList.innerHTML = '<div>Searching...</div>';
            fetch(`../backend/spotify_search.php?q=${encodeURIComponent(query)}`)
                .then(res => res.json())
                .then(data => {
                    if (data.tracks && data.tracks.items) {
                        renderSongs(data.tracks.items);
                    } else {
                        songList.innerHTML = '<div>No results found.</div>';
                    }
                })
                .catch(() => {
                    songList.innerHTML = '<div>Error fetching results.</div>';
                });
        });
    }

    function renderSongs(items) {
        songList.innerHTML = '';
        items.forEach(track => {
            const songDiv = document.createElement('div');
            songDiv.className = 'song';
            songDiv.innerHTML = `
                <span class="song-icon">🎵</span>
                <img src="${track.album.images[2]?.url || track.album.images[0]?.url || ''}" alt="Album Art">
                <div class="song-details">
                    <div class="song-title">${track.name}</div>
                    <div class="song-artist">${track.artists.map(a => a.name).join(', ')}</div>
                </div>
            `;
            songDiv.style.cursor = 'pointer';
            songDiv.onclick = () => {
                window.location.href = `song.html?id=${track.id}`;
            };
            songList.appendChild(songDiv);
        });
    }
});