<body>
<div class="regular_page">
    <p class="regular_txt bold_txt">Информация:</p>
    <div class="info_box">
        <p class="info_bold_txt">Мои контакты:</p>
        <div class="info_tel_box">
            <p class="info_tel_txt">Тел:</p>
            <a href="tel:+79209440332" class="info_tel_btn">+79209440332</a>
        </div>
        <p class="info_bold_txt">Специализация:</p>
        <p>Фитнес для девушек</p>
    </div>
    <div class="info_box">
        <p class="info_bold_txt">Я в социальных сетях:</p>
        <a href="https://vk.com/id107021619" target="_blank" class="info_address_btn_vk">Вконтакте</a>
    </div>
    <div class="info_box">
        <p class="info_bold_txt info_bold_txt_maps">Физкультурно-спортивный комплекс им. Ю.Н. Каперского</p>
        <a href="https://yandex.ru/maps/-/CHQTmUI4" target="_blank" class="info_address_btn">Курлово, ул. Школьная д. 20</a>
        <?php
        require $_SERVER['DOCUMENT_ROOT']."/sql.php";
        $result_allfit = $mysqli->query("SELECT DATE_FORMAT(date, '%d.%m'), DATE_FORMAT(date, '%H:%i'), case  WHEN DATE_FORMAT(date, '%W') = 'Sunday' THEN 'Воскресенье' WHEN DATE_FORMAT(date, '%W') = 'Monday' THEN 'Понедельник' WHEN DATE_FORMAT(date, '%W') = 'Tuesday' THEN 'Вторник' WHEN DATE_FORMAT(date, '%W') = 'Wednesday' THEN 'Среда' WHEN DATE_FORMAT(date, '%W') = 'Thursday' THEN 'Четверг' WHEN DATE_FORMAT(date, '%W') = 'Friday' THEN 'Пятница' WHEN DATE_FORMAT(date, '%W') = 'Friday' THEN 'Пятница' WHEN DATE_FORMAT(date, '%W') = 'Saturday' THEN 'Суббота' END FROM fit where date >= NOW() and date <= DATE_ADD(NOW(), INTERVAL 7 DAY)");
        $result_allfit = $result_allfit->fetch_all();
        foreach ($result_allfit as $fit) {
            ?><div class="sheduler_box">
                <p><? echo $fit[0]; echo " - "; echo $fit[2];?></p>
                <p><? echo $fit[1]; ?></p>
            </div><?
        }
        ?>
        <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3Ad1763f1663198954ea70f332394e29f3e5fee6c095254ab82c5fba2c2a8b5205&amp;source=constructor" height="250" frameborder="0"></iframe>
    </div>
</div>
</body>