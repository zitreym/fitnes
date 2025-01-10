<body>
<div class="sign_page">
<?php
require $_SERVER['DOCUMENT_ROOT']."/sql.php";
require $_SERVER['DOCUMENT_ROOT']."/botsettings.php";
?>
    <form action="<?php
            $name_user = $_POST['name_user'];
            $report_user = $_POST['report_user'];
            $date_now = date("Y-m-d");
            if (!empty($report_user)) {
$query = $mysqli->query("INSERT INTO reports (name, report, date) values ('$name_user', '$report_user', '$date_now')");
$message_for_tg = "Новый отзыв на сайте от $name_user - $report_user";
$getQuery = array(
    "chat_id" 	=> 688790193,
    "text"  	=> $message_for_tg,
    "parse_mode" => "html"
);
$ch = curl_init("https://api.telegram.org/bot". $token ."/sendMessage?" . http_build_query($getQuery));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, false);
$resultQuery = curl_exec($ch);
curl_close($ch);
            }
             ?>" method="post" class='form_sign'>
        <p class="form_txt_info">Оставить отзыв:</p>
        <div class='form_border'>
        <input type="text" class="form_input" placeholder="Ваше имя" name="name_user" required>
        <textarea class="form_message" placeholder="Ваш отзыв" name="report_user" required></textarea>
    </div>
        <input type="submit" value="ОТПРАВИТЬ" class="form_button">
    </form>
    <?php
        if (!empty($report_user)) {
        echo "<script>alert('$name_user, cпасибо за оставленный отзыв!')</script>";
        }
        ?>
</div>
</body>