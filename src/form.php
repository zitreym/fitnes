<body>
<div class="sign_page">
    <p class="regular_txt">тут будет форма для записи</p>
    <form action="<?php
    require $_SERVER['DOCUMENT_ROOT']."/sql.php";
            $name_user = $_POST['name_user'];
            $phone_user = $_POST['phone_user'];
            $fitchose_user = $_POST['fitchose_user'];
            if ($fitchose_user > 0) {
$query = $mysqli->query("INSERT INTO form (name, phone, fitchose) values ('$name_user', '$phone_user', $fitchose_user)");
            }
             ?>" method="post" class='form_sign'>
        <input type="text" class="form_input" placeholder="ВАШЕ ИМЯ*" name="name_user" required>
        <input type="text" class="form_input" placeholder="НОМЕР ТЕЛЕФОНА" name="phone_user" required>
        <?php
$result = $mysqli->query("SELECT *, DATE_FORMAT(date, '%d.%m %H:%i') FROM fit where date >= NOW() ");
$result = $result->fetch_all();
foreach ($result as $row) {
    ?>
            <div class='chose_radio'>
                <input name="fitchose_user" type="radio" value="<? echo $row[0]; ?>">
                <div class=txt_box_radio>
                    <div class='chose_radio_top'>
                        <p><? echo $row[5]; ?></p>
                        <p>Стоимость: <? echo $row[4]; ?>₽</p>
                    </div>
                    <div class='chose_radio_bot'>
                        <p><? echo $row[1]; ?></p>
                        <p><? echo $row[3]; ?></p>
                    </div>
                </div>
</div>
    <?
    }
    ?>
        <input type="submit" value="ОТПРАВИТЬ" class="form_button">
    </form>
</div>
</body>