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
$callback_text = $data['callback_query']['data'];
$callback_textArray = explode("_", $callback_text);


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
        $message_for_tg = "Это фитнес бот, выберите команду:";
        $keyboard_data = [[['text'=>'Список тренировок','callback_data'=>'/listfit'],['text'=>'Добавить тренировку','callback_data'=>'/addfit']]];
        sendTelegramKeyboard($userid, $message_for_tg, $keyboard_data, $token, $mysqli);
        break;
    default:
        $message_for_tg = "Я не знаю такую команду, для того, чтобы добавить тренировку, напишите так:
            добавить, название тренировки, описание тренировки, 2025-01-05 17:00, 250";
            sendTelegram($userid, $message_for_tg, $token, $mysqli);
        break;
}
}
else {
switch ($callback_textArray[0]) {
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
    case '/listfit':
        $result_allfit = $mysqli->query("SELECT *, DATE_FORMAT(date, '%d.%m %H:%i') FROM fit where date >= NOW()");
        $result_allfit = $result_allfit->fetch_all();
        $message_for_tg = "Список тренировок:";
        $keyboard_data_sql =[];
        foreach ($result_allfit as $fit){
			$callback_data = "/fitid" . "_" . $fit[0];
			$textbutton = $fit[5] . " " . $fit[1] . " (" . $fit[3] . ")";
            $keyboard_data_sql_new = array(
			array(
				"text" 	=> $textbutton,
				"callback_data"  => $callback_data
			));
			array_push($keyboard_data_sql, $keyboard_data_sql_new); 
        }
        sendTelegramKeyboard($data['callback_query']['from']['id'], $message_for_tg, $keyboard_data_sql, $token, $mysqli);
        break;
    case '/fitid':
        $result_allfit = $mysqli->query("SELECT *, DATE_FORMAT(date, '%d.%m %H:%i') FROM fit where id='$callback_textArray[1]'");
        $result_allfit = $result_allfit->fetch_all();
        $message_for_tg = "Выбрана тренировка id" . $result_allfit[0][0] . ":" . " " . $result_allfit[0][5] . " " . $result_allfit[0][1] . " (" . $result_allfit[0][3] . ")";
        $changefitid = "/changefitid" . "_" . $result_allfit[0][0];
        $deletefitid = "/deletefitid" . "_" . $result_allfit[0][0];
        $keyboard_data = [[['text'=>'Изменить','callback_data'=>$changefitid],['text'=>'Удалить','callback_data'=>$deletefitid]]];
        sendTelegramKeyboard($data['callback_query']['from']['id'], $message_for_tg, $keyboard_data, $token, $mysqli);
        break;
    case '/deletefitid':
        $result_allfit = $mysqli->query("DELETE fit where id='$callback_textArray[1]'");
        $message_for_tg = "Тренировка успешно удалена";
        sendTelegram($data['callback_query']['from']['id'], $message_for_tg, $token, $mysqli);
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