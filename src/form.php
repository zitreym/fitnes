<body>
<div class="sign_page">
    <p class="regular_txt">тут будет форма для записи</p>
    <form action="<?php
            $db_table = "form"; // Имя Таблицы БД
            $name_user = $_POST['name_user'];
            $fitchose = $_POST['fitchose'];
            $phone = $_POST['phone'];
            $name_user = htmlspecialchars($name_user);
            $phone = htmlspecialchars($phone);
            $name_user = urldecode($name_user);
            $email_user = urldecode($email_user);
            $phone = urldecode($phone);
            $message_user = urldecode($message_user);
            $name_user = trim($name_user);
            $phone = trim($phone);
            if ($phone > 1) {
$data = array( 'name' => $name_user, 'phone' => $phone, 'fitchose' => $fitchose);
$query = $mysqli->prepare("INSERT INTO $db_table (name, phone, fitchose) values (:name, :phone, :fitchose)");
$query->execute($data);
            }
             ?>" method="post">
        <input type="text" class="form_input" placeholder="ВАШЕ ИМЯ*" name="name_user" required>
        <input type="text" class="form_input" placeholder="НОМЕР ТЕЛЕФОНА" name="phone" required>
        <?php
require $_SERVER['DOCUMENT_ROOT']."/sql.php";
$result = $mysqli->query("SELECT * FROM fit where date >= NOW() ");
$result = $result->fetch_all();
foreach ($result as $row) {
    ?>
            <p><input name="fitchose" type="radio" value="<? echo $row[0]; ?>"><? echo $row[2]; ?><br><? echo $row[1]; ?><br><? echo $row[3]; ?><br><? echo $row[4]; ?></p>
    <?
    }
    ?>
        <input type="submit" value="ОТПРАВИТЬ" class="form_button">
    </form>
    <?php
        if ($phone > 1) {
        echo "<script>alert('Спасибо, вы успешно записаны на тренировку!')</script>";
        }
        ?>
</div>
</body>