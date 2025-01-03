<body>
<div class="sign_page">
    <form action="<?php
    require $_SERVER['DOCUMENT_ROOT']."/sql.php";
    require $_SERVER['DOCUMENT_ROOT']."/botsettings.php";
            $name_user = $_POST['name_user'];
            $phone_user = $_POST['phone_user'];
            $fitchose_user = $_POST['fitchose_user'];
            if ($fitchose_user > 0) {
$query = $mysqli->query("INSERT INTO form (name, phone, fitchose) values ('$name_user', '$phone_user', $fitchose_user)");
$result_fit = $mysqli->query("SELECT DATE_FORMAT(date, '%d.%m %H:%i'), name, description FROM fit where id='$code_fit'");
$result_fit = $result_fit->fetch_all();
$date_fit=$result_fit[0][0];
$name_fit=$result_fit[0][1];
$description_fit=$result_fit[0][2];
$message_for_tg = "Новая запись на тренировку $date_fit $name_fit $description_fit от $name_user с телефоном $phone_user";
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
             ?>" method="post" class='form_sign'>
        <p class="form_txt_info">Запись на тренировку:</p>
        <div class='form_border'>
        <input type="text" class="form_input" placeholder="Ваше имя" name="name_user" required>
        <input type="text" class="form_input" placeholder="Номер телефона" name="phone_user" required>
        <?php
$result = $mysqli->query("SELECT *, DATE_FORMAT(date, '%d.%m %H:%i') FROM fit where date >= NOW() ");
$result = $result->fetch_all();
foreach ($result as $row) {
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
</div>
</body>