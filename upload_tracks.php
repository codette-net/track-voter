<?php
// upload.php
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Upload Track</title>
  <link rel="stylesheet" href="style.css">

</head>
<body>
  <h1>Upload Track</h1>
  <form action="save_track.php" method="POST" enctype="multipart/form-data">
    <label>Artist: <input type="text" name="artist" required></label><br>
    <label>Title: <input type="text" name="title" required></label><br>
    <label>Track file (mp3/ogg): <input type="file" name="track_file"></label><br>
    <label>Or Soundcloud URL: <input type="url" name="soundcloud_url"></label><br>
    <button type="submit">Save</button>
  </form>
</body>
<footer><a href="index.php">Back to track list</a></footer>

</body>
</html>

