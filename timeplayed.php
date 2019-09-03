<?php

require 'utils.php';

function GetPlayerTimePlayedByName($playerName, $platform, $region) {
    $playerDataRequest = file_get_contents("https://r6tab.com/api/search.php?platform=uplay&search=".$playerName);
    
    $result = json_decode($playerDataRequest, true);
    
    if ($result['totalresults'] == 0) {
        die('No player found');
    } elseif ($result['totalresults'] > 1) {
        die('Found '.$result['totalresults'].' players with a similar name. Please try to use the player id instead of player name');
    }

    $playerId = $result['results'][0]['p_id'];
    
    $response = GetPlayerTimePlayedById($playerId, $platform, $region);

    return $response;
}

function GetPlayerTimePlayedById($playerId, $platform, $region) {    
    $playerDataRequest = file_get_contents("https://r6tab.com/api/player.php?p_id=".$playerId);
    
    $result = json_decode($playerDataRequest, true);

    if ($result['playerfound'] == false) {
        die('No player found');
    }

    $playerData = $result['p_data'];
    $playerData = str_replace('[', '', $playerData);
    $playerData = str_replace(']', '', $playerData);
    $playerData = explode(',', $playerData);

    $playerRankedTime = $playerData[0];
    $playerCasualTime = $playerData[5];

    $totalTimeInSeconds = $playerCasualTime + $playerRankedTime;
    
    $totalTime = secToHR($totalTimeInSeconds);
    $response = $totalTime;

    return $response;
}
