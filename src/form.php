<body>
<div class="sign_page">
    <p class="regular_txt">тут будет форма для записи</p>
<?php
require $_SERVER['DOCUMENT_ROOT']."/sql.php";
$result = $mysqli->query("SELECT * FROM fit");

?>
<p><? var_dump($result) ?></p>
</div>
</body>