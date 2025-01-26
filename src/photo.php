<body>
<div class="regular_page">
    <div class="photo_wrapper">
        <?
        require $_SERVER['DOCUMENT_ROOT']."/sql.php";
        $all_photo = $mysqli->query("SELECT src FROM photo");
        $all_photo = $all_photo->fetch_all();
        foreach ($all_photo as $photo) {
            $photoname = explode(".", $photo[0]);
            ?><div class="photo_box" onclick="toggleVisibility('<?echo $photoname[0];?>')" style="background-image: url(../static/photo/<?echo $photo[0];?>);"></div>
              <div class="photo_hidden" id="<?echo $photoname[0];?>" onclick="toggleVisibility('<?echo $photoname[0];?>')" style="background-image: url(../static/photo/<?echo $photo[0];?>);"></div><?
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
<script>
function toggleVisibility(info) {
  let element = document.getElementById(info);
  if (element.style.display === 'none') {
    element.style.display = 'block';
  } else {
    element.style.display = 'none';
  }
}
</script> 