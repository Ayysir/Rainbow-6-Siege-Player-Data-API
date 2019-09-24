<?php

include('mmr_to_rank.php');

function GetPlayerRankByName($playerName, $platform, $region) {
    $playerDataRequest = file_get_contents("https://r6tab.com/api/search.php?platform=uplay&search=".$playerName);
    
    $result = json_decode($playerDataRequest, true);

    if ($result['totalresults'] == 0) {
        die('No player found');
    } elseif ($result['totalresults'] > 1) {
        die('Found '.$result['totalresults'].' players with a similar name. Please try to use the player id instead of player name');
    }

    $playerId = $result['results'][0]['p_id'];
    
    $response = GetPlayerRankById($playerId, $platform, $region);

    return $response;
}

function GetPlayerRankById($playerId, $platform, $region) {

    //$json = file_get_contents('r6ranks.json');
    //$ranksNames = json_decode($json, true);
    
    $playerDataRequest = file_get_contents("https://r6tab.com/api/player.php?p_id=".$playerId);
    
    $result = json_decode($playerDataRequest, true);

    if ($result['playerfound'] == false) {
        die('No player found');
    }

    $playerUrl = 'https://r6tab.com/'.$playerId;

    $region = strtoupper($region);
    $platform = strtolower($platform);
    
    //$playerRankNumber = $result['p_'.$region.'_rank'];
    $playerMMR = $result['p_'.$region.'_currentmmr'];
    $playerDataLastUpdated = $result['updatedon'];

    $playerDataLastUpdated = str_replace('<u>', '', $playerDataLastUpdated);
    $playerDataLastUpdated = str_replace('</u>', '', $playerDataLastUpdated);
    
    $playerRankName = mmrToRank($playerMMR);
    
    $response = 'Region: '.$region.' | '.'Rank: '.$playerRankName.' | '.'MMR: '.$playerMMR.' | '.'Platform: '.strtoupper($platform).', '.$playerDataLastUpdated.', more info in '.$playerUrl;

    return $response;
}
