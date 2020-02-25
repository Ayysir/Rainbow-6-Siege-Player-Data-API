<?php

require 'rank.php';
require 'stats.php';
require 'timeplayed.php';

if (isset($_GET['p_name'])) {
    $playerName = $_GET['p_name'];

    //Check if a platform was inputed by the user
    if (!isset($_GET['platform']) || empty($_GET['platform'])) {
        die('Missing platform');
    } else {
        $platform = $_GET['platform'];
    }

    //Check if a region was inputed by the user
    if (!isset($_GET['region']) || empty($_GET['region'])) {
        die('Missing region');
    } else {
        $region = $_GET['region'];
    }

    //Check for the inputed command, if it does not exist use 'rank' by default
    if (isset($_GET['command'])) {
        if ($_GET['command'] == 'stats') {
            //Send the required data to the controller
            $response = GetPlayerStatsByName($playerName, $platform, $region);
        } elseif ($_GET['command'] == 'time') {
            //Send the required data to the controller
            $response = GetPlayerTimePlayedByName($playerName, $platform, $region);
        } elseif ($_GET['command'] == 'rank') {
            //Send the required data to the controller
            $response = GetPlayerRankByName($playerName, $platform, $region);
        } else {
            $response = "No command specified or that command does not exist";
        }
    } else {
        //Send the required data to the controller
        $response = GetPlayerRankByName($playerName, $platform, $region);
    }
    //Output the results
    echo $response;

} elseif (isset($_GET['p_id'])) {
    $playerId = $_GET['p_id'];

    //Check if a platform was inputed by the user
    /* if (!isset($_GET['platform']) || empty($_GET['platform'])) {
        die('Missing platform');
    } else {
        $platform = $_GET['platform'];
    } */

    //Check if a region was inputed by the user
    if (!isset($_GET['region']) || empty($_GET['region'])) {
        die('Missing region');
    } else {
        $region = $_GET['region'];
    }

    //Check for the inputed command, if it does not exist use 'rank' by default
    if (isset($_GET['command'])) {
        if ($_GET['command'] == 'stats') {
            //Send the required data to the controller
            $response = GetPlayerStatsById($playerId, $platform, $region);
        } elseif ($_GET['command'] == 'time') {
            //Send the required data to the controller
            $response = GetPlayerTimePlayedById($playerId, $platform, $region);
        } elseif ($_GET['command'] == 'rank') {
            //Send the required data to the controller
            $response = GetPlayerRankById($playerId, $platform, $region);
        } else {
            $response = "No command specified or that command does not exist";
        }
    } else {
        //Send the required data to the controller
        $response = GetPlayerRankById($playerId, $platform, $region);
    }

    //Output the results
    echo $response;

} else {
    echo 'No data sent...';
}
