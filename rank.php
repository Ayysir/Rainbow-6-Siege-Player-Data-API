<?php

if (!isset($_GET['p_name'])) {
    die('You need to send a player name');
} else {
    $playername = $_GET['p_name'];
}

$ranksNames = [
    1 => 'Copper IV',
    2 => 'Copper III',
    3 => 'Copper II',
    4 => 'Copper I',
    5 => 'Bronze IV',
    6 => 'Bronze III',
    7 => 'Bronze II',
    8 => 'Bronze I',
    9 => 'Silver IV',
    10 => 'Silver III',
    11 => 'Silver II',
    12 => 'Silver I',
    13 => 'Gold IV',
    14 => 'Gold III',
    15 => 'Gold II',
    16 => 'Gold I',
    17 => 'Platinum III',
    18 => 'Platinum II',
    19 => 'Platinum I',
    20 => 'Diamond'
];

$playerdatarequest = file_get_contents("https://r6tab.com/api/search.php?platform=uplay&search=".$playername);

$result = json_decode($playerdatarequest, true);

$playerRankNumber = $result['results'][0]['p_currentrank'];
$playerMMR = $result['results'][0]['p_currentmmr'];

$playerRankName = $ranksNames[$playerRankNumber];

echo $playerRankName.' | '.'MMR: '.$playerMMR;