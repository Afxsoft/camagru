<?php
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

function imageMerge($filter, $image){
    $src = imagecreatefrompng($filter);
    $data = base64_decode(str_replace("data:image/png;base64,",'', $image));
    $dest = imagecreatefromstring($data);

    imagecopymerge_alpha($dest, $src, 0, 0, 0, 0, 320, 240, 100);
    // Enable output buffering
    ob_start();
    imagepng($dest);
    $imagedata = ob_get_contents();
    ob_end_clean();

    return ($imagedata);
}