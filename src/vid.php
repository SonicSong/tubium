<?php
if (isset($_GET['video_id'])) {
    $videoId = $_GET['video_id'];
}

include_once 'ytVideo.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    echo "NIE :D";
    $video = new getYtVideo();
    $video->setVideoQuality($_REQUEST['quality']);
    $video->setVideoLink($videoId);
    $video->getVideo();
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tubium</title>
</head>
<body>
<div class="video_dl">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <p>Select video quality to watch video.</p>
        <label for="quality"><span>Video Quality:</span></label>
        <select name="quality" id="quality" required>
            <option value="best">Best</option>
        </select>
        <input type="submit" value="Download">
    </form>
</div>
<div class="header">
        <a href="../index.php"><h2>Tubium</h2></a>
        <form method="post" action="query_disp.php">
            <input type="text" name="query">
            <input type="submit" value="Search">
        </form>
    </div>
    <div class="video_disp">

    </div>
</body>
</html>