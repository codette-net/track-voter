<?php
$tracksFile = __DIR__ . '/tracks.json';
$tracks = file_exists($tracksFile) ? json_decode(file_get_contents($tracksFile), true) : [];
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Track Overview</title>
</head>
<body>
  <h1>Tracks</h1>
  <a href="upload.php">Upload new track</a>
  <ul>
    <?php foreach ($tracks as $track): ?>
      <li>
        <strong><?= htmlspecialchars($track['artist']) ?> - <?= htmlspecialchars($track['title']) ?></strong><br>
        <?php if ($track['is_soundcloud']): ?>
          <iframe width="100%" height="120" scrolling="no" frameborder="no"
                  src="https://w.soundcloud.com/player/?url=<?= urlencode($track['url']) ?>">
          </iframe>
        <?php else: ?>
          <audio controls>
            <source src="<?= htmlspecialchars($track['url']) ?>" type="audio/mpeg">
            Your browser does not support the audio element.
          </audio>
        <?php endif; ?>
        <div>
          <button onclick="vote('<?= $track['slug'] ?>')">Vote</button>
          <span id="votes-<?= $track['slug'] ?>"><?= $track['votes'] ?></span> votes
        </div>
      </li>
    <?php endforeach; ?>
  </ul>

  <script>
    async function vote(slug) {
      let res = await fetch('vote.php?slug=' + slug);
      let data = await res.json();
      if (data.success) {
        document.getElementById('votes-' + slug).innerText = data.votes;
      }
    }
  </script>
</body>
</html>
