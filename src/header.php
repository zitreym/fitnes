<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Фитнес для девушек</title>
        <link rel="stylesheet" href="/static/css/reset.css">
        <link rel="shortcut icon" href="/static/img/ico.png" type="image/png">
        <link rel="stylesheet" href="/static/css/style.css">
    </head>
<div class="wrapper">
<header class="header">
    <div class="header_photo">
        <div class="header_box">
            <div class="avatar"></div>
            <div class="header_text_box">
                <h1 class="name_txt_header">Баранова Татьяна</h1>
                <p class="info_txt_header">Фитнес<br>Курлово, ул.Школьная д.20</p>
            </div>
        </div>
    </div>
    <ul class="nav">
        <li><a href="/" class="nav_button nav_1"></a></li>
        <li><a href="/photo" class="nav_button nav_2"></a></li>
        <li><a href="/reports" class="nav_button 
        <? if ($_SERVER["REQUEST_URI"] == '/reports/') {
echo "nav_3_active";
}
else {
echo "nav_3";
}
?>"></a></li>
        <li><a href="/info" class="nav_button nav_4"></a></li>
    </ul>
</header>