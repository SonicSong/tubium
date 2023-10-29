<?php
if (isset($_SERVER['REQUEST_METHOD'])) {
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $query = $_REQUEST['query'];
    } else {
        echo "There is no search query";
    }
}

ytSearch($query);

function ytSearch($query){
    $yt_query = "https://www.youtube.com/results?search_query=";
    $transformedQuery = str_replace(' ', '+', $query);

    $html = file_get_contents($yt_query.$transformedQuery);

}