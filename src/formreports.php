<body>
<div class="sign_page">
<?php
require $_SERVER['DOCUMENT_ROOT']."/sql.php";
require $_SERVER['DOCUMENT_ROOT']."/botsettings.php";
require $_SERVER['DOCUMENT_ROOT']."/botfunctions.php";
?>
    <form action="<?php
            $name_user = $_POST['name_user'];
            $report_user = $_POST['report_user'];
            $date_now = date("Y-m-d");
            if (!empty($report_user)) {
$query = $mysqli->query("INSERT INTO reports (name, report, date) values ('$name_user', '$report_user', '$date_now')");
$message_for_tg = "Новый отзыв на сайте от $name_user - $report_user";
foreach ($admins as $admin) {
    sendTelegram($admin, $message_for_tg, $token, $mysqli);
}
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