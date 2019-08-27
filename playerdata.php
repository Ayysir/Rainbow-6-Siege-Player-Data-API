<?php 

require 'rank.php';

if (isset($_GET['p_name'])) {
    $playerName = $_GET['p_name'];
    $response = GetPlayerRankByName($playerName);
    echo $response;
} elseif (isset($_GET['p_id'])) {
    $playerId = $_GET['p_id'];
    $response = GetPlayerRankById($playerId);
    echo $response;
} else {
    echo 'No data sent...';
}
