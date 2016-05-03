<!--http://www.w3schools.com/php/php_file_upload.asp-->
<div id="banner-fade" class="center">

</div>
<div class="speration">
    <h2>fapfap</h2>
</div>
<div class="list_b center">
    <div id="filter">
        <input type="radio" name="filter" value="cadre"> <img src="img/tata.png"><br>
        <input type="radio" name="filter" value="tv"> <img src="img/tv.png"><br>
    </div>
    <video id="video"></video>
    <button id="startbutton">Prendre une photo</button>
    <canvas id="canvas"></canvas>
    <div id="fapfap"></div>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        Select image to upload:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload Image" name="submit">
    </form>
</div>