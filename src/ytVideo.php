<?php
include_once 'parser.php';
class getYtVideo {
    public $videoLink;
    public $videoQuality;
    function setVideoLink($videoLink){
        $this->videoLink = $videoLink;
    }

    function setVideoQuality($videoQuality){
        $this->videoQuality = $videoQuality;
    }

    function getVideo(){
        $vid = "https://www.youtube.com/".$this->videoLink;
        if($this->videoQuality === "best"){
            exec('cd tmp_vid');
            while (shell_exec('yt-dlp -f 22 "'.$vid.'"')){
                return "Downloading video";
            }

        } else {
            return "Please set quality";
        }
    }

    function loadVideo(){

    }

    function getVideoTitle(){
        $vid = "https://www.youtube.com/".$this->videoLink;
        $ytData = file_get_contents($vid);

        preg_match_all('/"title":\{"simpleText":"([^"]+(?:[^"]+[^"]+)*)"/', $ytData, $vidTitle, PREG_PATTERN_ORDER);

        if (isset($vidTitle[1][0])) {
            return $vidTitle[1][0];
        } else {
            return "No title found";
        }
    }
}