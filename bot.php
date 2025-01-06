<?php
require("botsettings.php");
require("sql.php");
$data = file_get_contents('php://input');
$data = json_decode($data, true);
$otvet = var_export($data, true);
$userid = $data['message']['from']['id'];
$username = $data['message']['from']['first_name'];
$lastname = $data['message']['from']['last_name'];
$nameid = $data['message']['from']['username'];
$text = $data['message']['text'];
$textArray = explode(", ", $text);

if (empty($data['message']['chat']['id'])) {
	exit();
}

switch ($textArray[0]) {
    case 'добавить':
        $query = $mysqli->query("INSERT INTO fit (name, description, date, price) values ('$textArray[1]', '$textArray[2]', '$textArray[3]', '$textArray[4]')");
        $message_for_tg = "Тренировка успешно добавлена";
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
        break;
    case '/start':
        $query = $mysqli->query("INSERT INTO fit (name, description, date, price) values ('$textArray[1]', '$textArray[2]', '$textArray[3]', '$textArray[4]')");
        $message_for_tg = "Это фитнес бот, чтобы добавить тренировку, напишите: добавить, название тренировки, описание тренировки, 2025-01-05 17:00, 250";
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
        break;
    default:
        $message_for_tg = "Я не знаю такую команду, для того, чтобы добавить тренировку, напишите так:
            добавить, название тренировки, описание тренировки, 2025-01-05 17:00, 250";
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
        break;
}