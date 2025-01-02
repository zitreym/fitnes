<body>
<div class="sign_page">
    <p class="regular_txt">тут будет форма для записи</p>
    <form action="<?php
    require $_SERVER['DOCUMENT_ROOT']."/sql.php";
            $name_user = $_POST['name_user'];
            $phone_user = $_POST['phone_user'];
            $fitchose_user = $_POST['fitchose_user'];
            if ($fitchofitchose_user != null) {
$query = "INSERT INTO form (name, phone, fitchose) values ('fff', '445345', 2)";
$resultinsert->execute($query);
            }
             ?>" method="post">
        <input type="text" class="form_input" placeholder="ВАШЕ ИМЯ*" name="name_user" required>
        <input type="text" class="form_input" placeholder="НОМЕР ТЕЛЕФОНА" name="phone_user" required>
        <?php
$result = $mysqli->query("SELECT * FROM fit where date >= NOW() ");
$result = $result->fetch_all();
foreach ($result as $row) {
    ?>
            <p><input name="fitchose_user" type="radio" value="<? echo $row[0]; ?>"><? echo $row[2]; ?><br><? echo $row[1]; ?><br><? echo $row[3]; ?><br><? echo $row[4]; ?></p>
    <?
    }
    ?>
        <input type="submit" value="ОТПРАВИТЬ" class="form_button">
    </form>
</div>
</body>