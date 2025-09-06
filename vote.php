<?php
$slug = $_GET['slug'] ?? '';
$tracksFile = __DIR__ . '/tracks.json';
$tracks = file_exists($tracksFile) ? json_decode(file_get_contents($tracksFile), true) : [];

$found = false;
foreach ($tracks as &$track) {
    if ($track['slug'] === $slug) {
        $track['votes']++;
        $found = true;
        $votes = $track['votes'];
        break;
    }
}
unset($track);

if ($found) {
    file_put_contents($tracksFile, json_encode($tracks, JSON_PRETTY_PRINT));
    echo json_encode(['success' => true, 'votes' => $votes]);
} else {
    echo json_encode(['success' => false]);
}
