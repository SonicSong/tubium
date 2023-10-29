<?php
include 'ytVideo.php';
function mainPage(){
    $ytData = file_get_contents('https://www.youtube.com/');
//    $tmpYt = fopen("yt.txt", "w") or die("Unable to open file!");
//    fwrite($tmpYt,$html);
//    fclose($tmpYt);
//    exec('sync');
//
//    $ytData = file_get_contents('yt.txt');

    preg_match_all('#\{"url":"/(watch\?v=[^"]+)(?:[^"]+)?#', $ytData, $ytLinks,  PREG_PATTERN_ORDER);

    $ytLinkMatch = $ytLinks[1];

    foreach ($ytLinkMatch as $key => $element) {
        if (strlen($element) > 20) {
            unset($ytLinkMatch[$key]);
        }
    }

    //$ytLinkMatch = array_values($ytLinkBef);

    preg_match_all('/"title":\{"runs":\[\{"text":"([^"]+(?:[^"]+[^"]+)*)"/', $ytData, $vidTitle,PREG_PATTERN_ORDER);

    $needle = '""title":{"runs":[{"text":';

    $vidTitle = array_filter($vidTitle[1], function ($element) use ($needle) {
        return !str_contains($element, $needle);
    });

    $key = array_search('\\', $vidTitle);
    if ($key !== false) {
        unset($vidTitle[$key]);
    }


    $stringsToRemove = [
        'Shorts',
        'Aktualności',
        'Na czasie',
        'Główna',
        'Skróty klawiszowe',
        'Odtwarzanie',
        'Ogólne',
        'Napisy',
        'Filmy sferyczne',
    ];

    $vidTitle = array_values(array_diff($vidTitle, $stringsToRemove));

    preg_match_all('#"thumbnails":\[\{"url":"(https:\/\/i.ytimg.com\/v[^"]+(?:hq720\.jpg)?)"#', $ytData, $vidThumbnail,PREG_PATTERN_ORDER);

    $vidThumbnail = array_filter($vidThumbnail[1], function ($vidElement) {
        return str_contains($vidElement, 'hq720.jpg');
    });

    $valueToCheck = [];

    foreach ($ytLinkMatch as $ytToFix) {
        preg_match('/watch\?v=(\w+)/', $ytToFix, $matches);
        $valueToCheck[] = $matches[1]; // Append the matched video ID to the array.
    }

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
    $vidTitleFin = array_values($vidTitle);

//    var_dump($ytLinkFin);
//    echo "<br>";
//    var_dump($vidTitleFin);
    var_dump($vidThumbFin);

    for ($i = 0; $i < count($ytLinkFin) && $i < count($vidThumbFin); $i++) {
        $video = new getYtVideo();
        echo $video->setVideoLink($ytLinkFin);
        // Request a video title directly from $ytLinkFin
        echo "<div>
        <a href='".$ytLinkFin[$i]."'>
            <img src='".$vidThumbFin[$i]."'>
            <p>"./*$video->getVideoTitle().*/"</p>
        </a>
    </div>";
    }}

mainPage();