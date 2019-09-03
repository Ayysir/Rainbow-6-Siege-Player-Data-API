<?php

function GetPlayerStatsByName($playerName, $platform, $region) {
    $playerDataRequest = file_get_contents("https://r6tab.com/api/search.php?platform=uplay&search=".$playerName);
    
    $result = json_decode($playerDataRequest, true);
    
    if ($result['totalresults'] == 0) {
        die('No player found');
    } elseif ($result['totalresults'] > 1) {
        die('Found '.$result['totalresults'].' players with a similar name. Please try to use the player id instead of player name');
    }

    $playerId = $result['results'][0]['p_id'];
    
    $response = GetPlayerStatsById($playerId, $platform, $region);

    return $response;
}

function GetPlayerStatsById($playerId, $platform, $region) {    
    $playerDataRequest = file_get_contents("https://r6tab.com/api/player.php?p_id=".$playerId);
    
    $result = json_decode($playerDataRequest, true);

    if ($result['playerfound'] == false) {
        die('No player found');
    }

    $playerLevel = $result['p_level'];
    $playerKD = $result['kd'] / 100;

    $playerData = $result['p_data'];
    $playerData = str_replace('[', '', $playerData);
    $playerData = str_replace(']', '', $playerData);
    $playerData = explode(',', $playerData);

    $playerRankedWins = $playerData[3];
    $playerRankedLosses = $playerData[4];

    $playerTotalRankedPlayed = $playerRankedWins + $playerRankedLosses;

    $playerRankedWinRate = $playerRankedWins / $playerTotalRankedPlayed * 100;

    $playerRankedWinRate = round($playerRankedWinRate, 2);
    
    $response = 'Lv. '.$playerLevel.' | '.$playerRankedWinRate.'% Win Rate'.' | '.$playerKD.' KD';

    return $response;
}
