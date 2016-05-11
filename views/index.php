<div id="banner-fade" class="center">

</div>
<div class="speration">
    <h2>fapfap</h2>
</div>
<div class="list_b center">
    <div class="left">
        <form id="filter">
            <input type="radio" name="filter" value="img/tata.png" onclick="activePhoto('img/tata.png')"> <img src="img/tata.png"><br>
            <input type="radio" name="filter" value="img/tv.png" onclick="activePhoto('img/tv.png')"> <img src="img/tv.png"><br>
        </form>
        <video id="video"></video>
        <button id="startbutton" disabled>Prendre une photo</button>
        <canvas id="canvas"></canvas>
        <div id="fapfap"></div>
        <form action="index.php?page=index&action=upload" method="post" enctype="multipart/form-data">
            Select image to upload:
            <input type="file" name="fileToUpload" id="fileToUpload" disabled>
            <input type="submit" value="Upload Image" name="submit" id="startUpload" disabled>
            <input type="hidden" name="filter" value="" id="hidenfilter">
        </form>
    </div>

    <aside>
        <?php
        $images = getImageByUserId($DBH, getCurrentUserId($DBH));
        if(!empty($images)){
            foreach ($images as $image){
                foreach ($image as $key => $value){
                    if($key == 'filtered')
                    {
                        echo "<img src='".$value."'> <a href='index.php?page=image&action=del&id=".$image->id."'> Delete me </a>";
                    }
                }
            }
        }

        ?>
    </aside>

</div>