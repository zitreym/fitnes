<?php
require("botsettings.php");
require("sql.php");
require("botfunctions.php");
$data = file_get_contents('php://input');
$query_tg = $mysqli->query("INSERT INTO tglog (log) values ('$data')");
$data = json_decode($data, true);
$userid = $data['message']['from']['id'];
$username = $data['message']['from']['first_name'];
$lastname = $data['message']['from']['last_name'];
$nameid = $data['message']['from']['username'];
$text = $data['message']['text'];
$textArray = explode(", ", $text);

if (empty($data['callback_query']['data'])) {
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
        $query_tg = $mysqli->query("INSERT INTO tglog (log) values ('$resultQuery')");
        break;
    case '/start':
        $message_for_tg = "Это фитнес бот, чтобы добавить тренировку, напишите: добавить, название тренировки, описание тренировки, 2025-01-05 17:00, 250";
        sendTelegram($userid, $message_for_tg, $token, $mysqli);
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
        $query_tg = $mysqli->query("INSERT INTO tglog (log) values ('$resultQuery')");
        break;
}
}
else {
switch ($data['callback_query']['data']) {
    case '/change':
        $message_for_tg = "Вы выбрали изменить тренировку";
        $getQuery = array(
            "chat_id" 	=> $data['callback_query']['from']['id'],
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
    case '/delete':
        $message_for_tg = "Вы выбрали удалить тренировку";
        $getQuery = array(
            "chat_id" 	=> $data['callback_query']['from']['id'],
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
        $message_for_tg = "Я не знаю такую команду ответа";
        $getQuery = array(
            "chat_id" 	=> $data['callback_query']['from']['id'],
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
}
}