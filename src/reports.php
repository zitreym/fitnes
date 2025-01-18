<body>
<div class="regular_page">
    <p class="regular_txt bold_txt">Отзывы:</p>
    
<?php
require $_SERVER['DOCUMENT_ROOT']."/sql.php";
$result_reports = $mysqli->query("SELECT *, DATE_FORMAT(date, '%d.%m') FROM reports");
$result_reports = $result_reports->fetch_all();
foreach ($result_reports as $report) {?>
<div class="box_report">
    <div class="user_report_about_box">
        <div class="user_report_box">
            <div class="user_report_avatar"></div>
            <p><? echo $report[1]; ?></p>
        </div>
        <p><? echo $report[4]; ?></p>
    </div>
    <p><? echo $report[2]; ?></p>
</div>
<?
}
?>
    <a href="/formreports" class="sign_btn">Оставить отзыв</a>
</div>
</body>