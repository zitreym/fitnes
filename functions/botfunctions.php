<?php
function sendTelegram($userid, $message_for_tg)
{
    $getQuery = array(
        "chat_id" 	=> $userid,
        "text"  	=> $message_for_tg,
        "parse_mode" => "html"
    );
    $ch = curl_init("https://api.telegram.org/bot". $token ."/sendMessage?" . http_build_query($getQuery));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, false);
    $resultQuery = curl_exec($ch);
    curl_close($ch);
    $query_tg = $mysqli->query("INSERT INTO tglog (log) values ('$resultQuery')");
}
?>