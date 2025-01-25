<body>
<div class="regular_page">
    <div class="photo_wrapper">
        <?
        require $_SERVER['DOCUMENT_ROOT']."/sql.php";
        $all_photo = $mysqli->query("SELECT src FROM photo");
        $all_photo = $all_photo->fetch_all();
        foreach ($all_photo as $photo) {
            ?><div class="photo_box" style="background-image: url(../static/photo/<?echo $photo[0];?>);"></div><?
        }
        $count_photo=count($all_photo);
        $ostatok = ($count_photo % 3);
        if ($ostatok > 0) {
            $ostatok = 3 - $ostatok;
            while ($ostatok>0) {
                ?><div class="photo_box_empty"></div><?
                $ostatok = $ostatok-1;
            }
        }
        ?>
    </div>
</div>
</body>