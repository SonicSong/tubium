<?php

function ytSearch($query){
    $yt_query = "https://www.youtube.com/results?search_query=";
    $transformedQuery = str_replace(' ', '+', $query);

    $html = file_get_contents($yt_query.$transformedQuery);
    echo $html;
}