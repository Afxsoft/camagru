<?php
if ($_GET['action'] == 'format' && !empty($_POST['filter']) && !empty($_POST['image'])){
    function imagecopymerge_alpha($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct){
        // creating a cut resource
        $cut = imagecreatetruecolor($src_w, $src_h);

        // copying relevant section from background to the cut resource
        imagecopy($cut, $dst_im, 0, 0, $dst_x, $dst_y, $src_w, $src_h);

        // copying relevant section from watermark to the cut resource
        imagecopy($cut, $src_im, 0, 0, $src_x, $src_y, $src_w, $src_h);

        // insert cut resource to destination image
        imagecopymerge($dst_im, $cut, $dst_x, $dst_y, 0, 0, $src_w, $src_h, $pct);
    }

    $src = imagecreatefrompng('file:///nfs/2015/a/aouloube/Downloads/tata.png');
    $dest = imagecreatefrompng('file:///nfs/2015/a/aouloube/Downloads/toto.png');

    imagecopymerge_alpha($dest, $src, 0, 0, 0, 0, 320, 240, 100);

    header('Content-Type: image/png');
    imagepng($dest);

    imagedestroy($dest);
    imagedestroy($src);
    exit();
}elseif ($_GET['action'] == 'get'){
    header('Content-Type: application/json');
    echo json_encode($_SESSION['basket']);
    exit();
}elseif($_GET['action'] == 'set'){
    if(!empty($_POST['filter']) && !empty($_POST['image'])){
        $currentUser  = findById($DBH, 'USER', 'username', $_SESSION['loggued_on_user']);
        //insert($DBH, array('main' => $_POST['image'], 'filtered' => $_POST['filter']), 'IMAGE');
    }
}