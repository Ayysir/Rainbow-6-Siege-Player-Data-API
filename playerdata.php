<?php 

require 'rank.php';

if (isset($_GET['p_name'])) {
    $playerName = $_GET['p_name'];

    if (!isset($_GET['platform']) || empty($_GET['platform'])) {
        die('Missing platform');
        
    } else {
        $platform = $_GET['platform'];
    }

    if (!isset($_GET['region']) || empty($_GET['region'])) {
        die('Missing region');
    } else {
        $region = $_GET['region'];
    }
    
    $response = GetPlayerRankByName($playerName, $platform, $region);
    echo $response;

} elseif (isset($_GET['p_id'])) {
    $playerId = $_GET['p_id'];

    if (!isset($_GET['platform']) || empty($_GET['platform'])) {
        die('Missing platform');
    } else {
        $platform = $_GET['platform'];
    }

    if (!isset($_GET['region']) || empty($_GET['region'])) {
        die('Missing region');
    } else {
        $region = $_GET['region'];
    }

    $response = GetPlayerRankById($playerId, $platform, $region);
    echo $response;
} else {
    echo 'No data sent...';
}
