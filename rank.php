<?php

function GetPlayerRankByName($playerName) {

    $json = file_get_contents('r6ranks.json');
    $ranksNames = json_decode($json, true);
    
    $playerdatarequest = file_get_contents("https://r6tab.com/api/search.php?platform=uplay&search=".$playerName);
    
    $result = json_decode($playerdatarequest, true);
    
    $playerRankNumber = $result['results'][0]['p_currentrank'];
    $playerMMR = $result['results'][0]['p_currentmmr'];
    
    $playerRankName = $ranksNames[$playerRankNumber];
    
    $response = $playerRankName.' | '.'MMR: '.$playerMMR;

    return $response;
}
