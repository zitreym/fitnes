<body>
<div class="sign_page">
<?php
require $_SERVER['DOCUMENT_ROOT']."/sql.php";
require $_SERVER['DOCUMENT_ROOT']."/botsettings.php";
require $_SERVER['DOCUMENT_ROOT']."/botfunctions.php";
$result_allfit = $mysqli->query("SELECT *, DATE_FORMAT(date, '%d.%m %H:%i') FROM fit where date >= NOW() ");
$result_allfit = $result_allfit->fetch_all();
if (empty($result_allfit)) {
    ?><p class="regular_txt">Сейчас нет тренировки на которую можно записаться, заходите позднее</p><?
}
else {
?>
    <form action="<?php
            $name_user = $_POST['name_user'];
            $phone_user = $_POST['phone_user'];
            $fitchose_user = $_POST['fitchose_user'];
            if ($fitchose_user > 0) {
$query = $mysqli->query("INSERT INTO form (name, phone, fitchose) values ('$name_user', '$phone_user', $fitchose_user)");
$result_fit = $mysqli->query("SELECT DATE_FORMAT(date, '%d.%m %H:%i'), name, description FROM fit where id='$fitchose_user'");
$result_fit = $result_fit->fetch_all();
$date_fit=$result_fit[0][0];
$name_fit=$result_fit[0][1];
$description_fit=$result_fit[0][2];
$message_for_tg = "Новая запись на тренировку $date_fit $name_fit $description_fit от $name_user с телефоном $phone_user";
$phone_user = removeBracketsAndPlus($phone_user);
$waurl = takewaurl($phone_user);
$keyboard_data = [[['text'=>'Написать WhatsApp','url'=>$waurl]]];
if ($waurl == "badnumber") {
    foreach ($admins as $admin) {
    sendTelegram($admin, $message_for_tg, $token, $mysqli);
}
}
else {
    foreach ($admins as $admin) {
    sendTelegramKeyboard($admin, $message_for_tg, $keyboard_data, $token, $mysqli);
    }
}
}
             ?>" method="post" class='form_sign'>
        <p class="form_txt_info">Запись на тренировку:</p>
        <div class='form_border'>
        <input type="text" class="form_input" placeholder="Ваше имя" name="name_user" required>
        <input type="text" class="form_input" placeholder="Номер телефона" name="phone_user" required>
        <?php
foreach ($result_allfit as $row) {
    ?>
            <div class='chose_radio'>
                <input class='radio_chose' name="fitchose_user" type="radio" value="<? echo $row[0]; ?>">
                <div class=txt_box_radio>
                    <div class='chose_radio_top'>
                        <p><? echo $row[5]; ?></p>
                        <p><? echo $row[4]; ?>₽</p>
                    </div>
                    <div class='chose_radio_bot'>
                        <p class='radio_chose'><? echo $row[1]; ?></p>
                        <p><? echo $row[3]; ?></p>
                    </div>
                </div>
</div>
    <?
    }
    ?>
    </div>
        <input type="submit" value="ОТПРАВИТЬ" class="form_button">
    </form>
    <?
    if (!empty($fitchose_user)) {
        echo "<script>alert('$name_user, вы успешно записались на тренировку: $name_fit')</script>";
        }
    }
        ?>
</div>
</body>