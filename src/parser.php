<?php
include 'ytVideo.php';
function mainPage(){
    $ytData = file_get_contents('https://www.youtube.com/');

    preg_match_all('#\{"url":"/(watch\?v=[^"]+)(?:[^"]+)?#', $ytData, $ytLinks,  PREG_PATTERN_ORDER);

    $ytLinkMatch = $ytLinks[1];

    foreach ($ytLinkMatch as $key => $element) {
        if (strlen($element) > 20) {
            unset($ytLinkMatch[$key]);
        }
    }

    preg_match_all('#"thumbnails":\[\{"url":"(https:\/\/i.ytimg.com\/v[^"]+(?:hq720\.jpg)?)"#', $ytData, $vidThumbnail,PREG_PATTERN_ORDER);

    $vidThumbnail = array_filter($vidThumbnail[1], function ($vidElement) {
        return str_contains($vidElement, 'hq720.jpg');
    });

    $valueToCheck = [];

    foreach ($ytLinkMatch as $ytToFix) {
        preg_match('/watch\?v=(\w+)/', $ytToFix, $matches);
        $valueToCheck[] = $matches[1]; // Append the matched video ID to the array.
    }
    var_dump($valueToCheck);

    $resultVidThumb = [];

    foreach ($valueToCheck as $videoID) {
        foreach ($vidThumbnail as $thumbUrl) {
            if (str_contains($thumbUrl, $videoID)) {
                $resultVidThumb[] = $thumbUrl;
            }
        }
    }
    $resultVidThumb = array_unique($resultVidThumb);

    // THIS SHIT IS IMPORTANT!
    $ytLinkFin = array_values($ytLinkMatch); //Fixes order of video links, so they won't appear in array as 0, 14, 16, 18, etc.
    $vidThumbFin = array_values($resultVidThumb);

    for ($i = 0; $i < count($ytLinkFin) && $i < count($vidThumbFin); $i++) {
        $video = new getYtVideo();
        $video->setVideoLink($ytLinkFin[$i]);
        echo "<div>
            <a href='src/vid.php?video_id=".$ytLinkFin[$i]."'>
            <img src='".$vidThumbFin[$i]."'>
            <p>".$video->getVideoTitle()."</p>
        </a>
    </div>";
    }}
//
mainPage();