<?php
$tracksFile = __DIR__ . '/tracks.json';
$tracks = file_exists($tracksFile) ? json_decode(file_get_contents($tracksFile), true) : [];
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="style.css">
  <title>Track Overview</title>

</head>
<body>
  <h1>Tracks for US 001</h1>
  <section>
    <ul>
      <?php foreach ($tracks as $track): ?>
        <li>
          <h3><strong><?= htmlspecialchars($track['artist']) ?> - <?= htmlspecialchars($track['title']) ?></strong></h3>
          <?php if ($track['is_soundcloud']): ?>
            <iframe width="100%" height="120" scrolling="no" frameborder="no"
                    src="https://w.soundcloud.com/player/?url=<?= urlencode($track['url']) ?>">
            </iframe>
          <?php else: ?>
            <audio controls>
              <source src="<?= htmlspecialchars($track['url']) ?>" type="audio/mpeg" preload="auto">
              Your browser does not support the audio element.
            </audio>
          <?php endif; ?>
          <div>
            <button onclick="vote('<?= $track['slug'] ?>')">Vote</button>
            <strong><span id="votes-<?= $track['slug'] ?>"><?= $track['votes'] ?></span> votes</strong>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>
  </section>

  <footer><a href="upload_tracks.php">Upload new track</a></footer>


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
