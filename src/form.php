<body>
<div class="sign_page">
    <p class="regular_txt">тут будет форма для записи</p>
    <form action="<?php
    require $_SERVER['DOCUMENT_ROOT']."/sql.php";
            $db_table = "form"; // Имя Таблицы БД
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $fitchose = $_POST['fitchose'];
            $name = htmlspecialchars($name);
            $phone = htmlspecialchars($phone);
            $fitchose = htmlspecialchars($fitchose);
            $name = urldecode($name);
            $phone = urldecode($phone);
            $fitchose = urldecode($fitchose);
            $name = trim($name);
            $phone = trim($phone);
            $fitchose = trim($fitchose);
            if ($phone > 1) {
$data = array( 'name' => $name, 'phone' => $phone, 'fitchose' => $fitchose);
$query = $mysqli->prepare("INSERT INTO $db_table (name, phone, fitchose) values (:name, :phone, :fitchose)");
$query->execute($data);
            }
             ?>" method="post">
        <input type="text" class="form_input" placeholder="ВАШЕ ИМЯ*" name="name" required>
        <input type="text" class="form_input" placeholder="НОМЕР ТЕЛЕФОНА" name="phone" required>
        <?php
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