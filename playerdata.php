<?php 

require 'rank.php';

if (isset($_GET['p_name'])) {
    $playerName = $_GET['p_name'];
    $response = GetPlayerRankByName($playerName);
    echo $response;
} else {
    echo 'nay';
}
