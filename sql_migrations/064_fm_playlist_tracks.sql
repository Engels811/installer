-- ============================================================
-- Migration: 064_fm_playlist_tracks
-- ============================================================

CREATE TABLE IF NOT EXISTS fm_playlist_tracks (
        playlist_id INT NOT NULL,
        track_id INT NOT NULL,
        position INT DEFAULT 0,
        PRIMARY KEY (playlist_id, track_id),
        FOREIGN KEY (playlist_id) REFERENCES fm_playlists(id) ON DELETE CASCADE,
        FOREIGN KEY (track_id) REFERENCES fm_tracks(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;;
