<?php
$artist = trim($_POST['artist'] ?? '');
$title  = trim($_POST['title'] ?? '');
$soundcloud = trim($_POST['soundcloud_url'] ?? '');
$slug   = strtolower(preg_replace('/[^a-z0-9]+/i', '-', $artist . '-' . $title));

if (!$artist || !$title) {
    die("Artist and title are required.");
}

$uploadPath = '';
if (!empty($_FILES['track_file']['name'])) {
    $file = $_FILES['track_file'];
    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $filename = $slug . '.' . $ext;
    $dest = __DIR__ . '/uploads/' . $filename;
    if (move_uploaded_file($file['tmp_name'], $dest)) {
        $uploadPath = 'uploads/' . $filename;
    }
}

// Load existing tracks
$tracksFile = __DIR__ . '/tracks.json';
$tracks = file_exists($tracksFile) ? json_decode(file_get_contents($tracksFile), true) : [];

$tracks[] = [
    'artist' => $artist,
    'title'  => $title,
    'slug'   => $slug,
    'url'    => $uploadPath ?: $soundcloud,
    'votes'  => 0,
    'is_soundcloud' => !empty($soundcloud)
];

// Save back
file_put_contents($tracksFile, json_encode($tracks, JSON_PRETTY_PRINT));

header("Location: index.php");
exit;
