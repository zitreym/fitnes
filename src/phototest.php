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
        ?>
    </div>
</div>
</body>