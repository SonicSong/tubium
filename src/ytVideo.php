<?php
class getYtVideo {
    public $videoLink;
    private $watch = 'https://www.youtube.com/';
    function setVideoLink($videoLink){
        $this->videoLink = $videoLink;
    }

    function getVideoTitle(){
        $vid = "https://www.youtube.com/".$this->videoLink;
        //$vid = "https://www.youtube.com/watch?v=3nLrkkl6mtU";
        $ytData = file_get_contents($vid);
//        $tmpYt = fopen("yt.txt", "w") or die("Unable to open file!");
//        fwrite($tmpYt,$ytData);
//        fclose($tmpYt);

        preg_match_all('/"title":\{"simpleText":"([^"]+(?:[^"]+[^"]+)*)"/', $ytData, $vidTitle, PREG_PATTERN_ORDER);

        if (isset($vidTitle[1][0])) {
            $finalVidTitle = $vidTitle[1][0]; // Get the first title from the array
            return $finalVidTitle;
        } else {
            return "No title found"; // Handle the case where no title is found
        }    }
}
