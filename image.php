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

    function getAllImage($DBH, $start=0){
        return (fetchAll($DBH, 'IMAGE', '1', '*', '3 ASC' , 'LIMIT '.$start.', 3'));
    }

    function getImageByUserId($DBH, $userId){
        return(findById($DBH, 'IMAGE', 'user', $userId));
    }
    function base64_to_jpeg($base64_string, $output_file) {
        $ifp = fopen($output_file, "wb");

        $data = explode(',', $base64_string);

        fwrite($ifp, base64_decode($data[1]));
        fclose($ifp);

        return $output_file;
    }
    function addImage($DBH, $filter, $image)
    {
        $currentUser  = findById($DBH, 'USER', 'username', $_SESSION['loggued_on_user']);
        $userId = !empty($currentUser[0]->id) ? $currentUser[0]->id : null;
        $filtered = imageMerge($filter, $image);
        $image = base64_to_jpeg( $filtered, 'camagru/'.$userId.'_'.time().'.jpg');
        insert($DBH, array('main' => $image, 'filtered' => $image, 'user' => $userId), 'IMAGE');
    }
    function uploadImage($DBH){
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

                addImage($DBH, $_POST['filter'], $base64);
                unlink($target_file);

            } else {
                setMessage('error', "Sorry, there was an error uploading your file.");
            }
        }
    }
    function deleteImageById($DBH, $id){
        $image = findById($DBH, 'IMAGE', 'id', $id);
        if(!empty($image[0]->user)){
            if($image[0]->user == getCurrentUserId($DBH))
            {
                delete($DBH, 'image', 'id', $id);
            }
        }
        else
            setMessage('error', 'Your are not allowed');
    }
    function likeImagebyId($DBH, $id)
    {
        $imageLike = findById($DBH, 'IMAGE_LIKE', 'image', $id);

        $checker = 1;
        if(!empty($imageLike[0])){
            foreach ($imageLike as $like)
            {

                if($like->user == getCurrentUserId($DBH))
                {
                    delete($DBH, 'image_like', 'user', getCurrentUserId($DBH));
                    $checker = 0;
                }
            }
            if ($checker){
                insert($DBH, array('user' => getCurrentUserId($DBH), 'image' => $id), 'IMAGE_LIKE');
            }
        }elseif ($checker){
            insert($DBH, array('user' => getCurrentUserId($DBH), 'image' => $id), 'IMAGE_LIKE');
        }

    }
    function checkIfLike($DBH, $id)
    {
        $imageLike = findById($DBH, 'IMAGE_LIKE', 'image', $id);

        if(!empty($imageLike[0])){
            foreach ($imageLike as $like)
            {
                if($like->user == getCurrentUserId($DBH))
                    return(true);
            }
        }

        return(false);
    }

    function countImageLike($DBH, $id){
        $total = countById($DBH, 'IMAGE_LIKE', 'image', $id);
        return($total[0]->total);
    }
    function addImageCom($DBH, $id, $msg){
        $image = findById($DBH, 'IMAGE', 'id', $id);
        if(!empty($image)){
            $user = findById($DBH, 'USER', 'id', $image[0]->user);
            if(insert($DBH, array('message' => htmlentities($msg), 'user' => getCurrentUserId($DBH), 'image' => $id), 'COM'))
                sendMail($user[0]->mail, 'Image comm', 'One of your image have recieve a commentaire');
        }

    }
    function getImageComById($DBH, $id){
        return(findById($DBH, 'COM', 'image', $id));
    }
