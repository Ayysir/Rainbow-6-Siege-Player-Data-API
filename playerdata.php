<?php 

require 'rank.php';
require 'stats.php';
require 'timeplayed.php';

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

    if (isset($_GET['command'])) {
        if ($_GET['command'] == 'stats') {
            $response = GetPlayerStatsByName($playerName, $platform, $region);
        } elseif (!isset($_GET['command']) || $_GET['command'] == 'time') {
            $response = GetPlayerTimePlayedByName($playerName, $platform, $region);
        } elseif (!isset($_GET['command']) || $_GET['command'] == 'rank') {
            $response = GetPlayerRankByName($playerName, $platform, $region);
    }
}
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

    if (isset($_GET['command'])) {
        if ($_GET['command'] == 'stats') {
            $response = GetPlayerStatsById($playerId, $platform, $region);
        } elseif (!isset($_GET['command']) || $_GET['command'] == 'time') {
            $response = GetPlayerTimePlayedById($playerId, $platform, $region);
        } elseif (!isset($_GET['command']) || $_GET['command'] == 'rank') {
            $response = GetPlayerRankById($playerId, $platform, $region);
    }

    echo $response;
} else {
    echo 'No data sent...';
    }
}
