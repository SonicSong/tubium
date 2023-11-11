<?php
//include_once 'parser.php';
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
        chdir('tmp_vid');
        $cmd = 'yt-dlp -P /Users/roberts/Desktop/tmp_vid -f 22 "'.$vid.'"';

        while (@ ob_end_flush()); // end all output buffers if any

        $proc = popen($cmd, 'r');
        echo '<pre>';
        while (!feof($proc))
        {
            echo fread($proc, 4096);
            @ flush();
        }
        echo '</pre>';
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
