<body>
<div class="sign_page">
<?php
require $_SERVER['DOCUMENT_ROOT']."/sql.php";
require $_SERVER['DOCUMENT_ROOT']."/botsettings.php";
?>
    <form action="<?php
            $name_user = $_POST['name_user'];
            $experience_user = $_POST['experience_user'];
            $report_user = $_POST['report_user'];
            $rating_user = $_POST['rating_user'];
            $date_now = date("d.m.y");
            if (!empty($report_user)) {
$query = $mysqli->query("INSERT INTO reports (name, experience, report, rating, date) values ('$name_user', '$experience', '$report_user', '$rating_user' '$date_now')");
$message_for_tg = "Новый отзыв на сайте от $report_user - $report_user";
foreach ($admins as $admin) {
$getQuery = array(
    "chat_id" 	=> $admin,
    "text"  	=> $message_for_tg,
    "parse_mode" => "html"
);
$ch = curl_init("https://api.telegram.org/bot". $token ."/sendMessage?" . http_build_query($getQuery));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, false);
$resultQuery = curl_exec($ch);
curl_close($ch);
}

            }
             ?>" method="post" class='form_sign'>
        <p class="form_txt_info">Оставить отзыв:</p>
        <div class='form_border'>
        <input type="text" class="form_input" placeholder="Ваше имя" name="name_user" required>
        <div>
            <p>Сколько вы занимаетесь?</p>
            <div><p>1 занятие</p><input class='radio_chose' name="fitchose_user" type="radio" value="1 занятие"></div>
            <div><p>До 10 занятий</p><input class='radio_chose' name="fitchose_user" type="radio" value="До 10 занятий"></div>
            <div><p>Более 10 занятий</p><input class='radio_chose' name="fitchose_user" type="radio" value="Более 10 занятий"></div>
        </div>
        <div>
        <p>Оценка</p>
        <input type=range min=0 max=5 name="rating_user">
        </div>
        <textarea class="form_message" placeholder="Ваш отзыв" name="report_user" required></textarea>
    </div>
        <input type="submit" value="ОТПРАВИТЬ" class="form_button">
    </form>
</div>
</body>