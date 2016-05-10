<?php

    function imagecopymerge_alpha($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct){
        $cut = imagecreatetruecolor($src_w, $src_h);
        imagecopy($cut, $dst_im, 0, 0, $dst_x, $dst_y, $src_w, $src_h);
        imagecopy($cut, $src_im, 0, 0, $src_x, $src_y, $src_w, $src_h);
        imagecopymerge($dst_im, $cut, $dst_x, $dst_y, 0, 0, $src_w, $src_h, $pct);
    }

    function imageMerge($filter, $image){
        $src  = imagecreatefrompng($filter);
        $data = base64_decode(str_replace("data:image/png;base64,",'', $image));
        $dest = imagecreatefromstring($data);

        imagecopymerge_alpha($dest, $src, 0, 0, 0, 0, 320, 240, 100);
        ob_start();
            imagepng($dest);
            $imagedata = ob_get_contents();
        ob_end_clean();

        return ('data:image/png;base64,'.base64_encode($imagedata));
    }

    function getAllImage($DBH){
        return (fetchAll($DBH, 'IMAGE', '1', '*', '3 ASC'));
    }

    function getImageByUserId($DBH, $userId){
        return(findById($DBH, 'IMAGE', 'user', $userId));
    }
    function uploadImage(){
        $target_dir = "/tmp/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                setMessage('info', "File is an image - " . $check["mime"] . ".") ;
                $uploadOk = 1;
            } else {
                setMessage('error', "File is not an image.");
                $uploadOk = 0;
            }
        }
        if (file_exists($target_file)) {
            setMessage('error', "Sorry, file already exists.");
            $uploadOk = 0;
        }
// Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            setMessage('error', "Sorry, your file is too large.");
            $uploadOk = 0;
        }
// Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
            setMessage('error', "Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
            $uploadOk = 0;
        }
// Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            setMessage('error', "Sorry, your file was not uploaded");
// if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {


                $path = $target_file;
                $type = pathinfo($path, PATHINFO_EXTENSION);
                $data = file_get_contents($path);
                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                $data = array('filter' => $_POST['filter'], 'image' => $base64);

                var_dump($)
//                $handle = curl_init('http://localhost:8080/camagru/index.php?page=image&action=set');
//                curl_setopt($handle, CURLOPT_POST, true);
//                curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
//                curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
//
//                var_dump(curl_exec($handle));

            } else {
                setMessage('error', "Sorry, there was an error uploading your file.");
            }
        }
    }