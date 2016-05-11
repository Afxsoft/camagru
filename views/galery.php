<div class="list_b center">
    <div>
        <?php
        $pageStart = !empty($_GET['pager']) ? $_GET['pager'] : 0;
        $images = getAllImage($DBH, $pageStart);
        if(!empty($images)){
            foreach ($images as $image){
                foreach ($image as $key => $value){
                    if($key == 'filtered')
                    {
                        $like = (checkIfLike($DBH, $image->id)) ? "<a href='index.php?page=galery&action=like&id=".$image->id."'>Dislike</a>" : "<a href='index.php?page=galery&action=like&id=".$image->id."'>Liker</a>";
                        $form = "
                        <form action='index.php?page=galery&action=add&id=".$image->id."' method='POST'>
                            <textarea name='com' rows='4' cols='50'>
                            </textarea>
                            <input type='submit' name='submit' value='Add com'>
                        </form>
                        ";
                        echo "<img src='".$value."'> nb like: ". countImageLike($DBH, $image->id)." <br>";
                        if(userIslog()) {
                            echo $like;

                            if ($coms = getImageComById($DBH, $image->id)) {
                                foreach ($coms as $com) {

                                    $user = findById($DBH, 'USER', 'id', $com->user);
                                    echo "<br> auteur: " . $user[0]->username . '<br>';
                                    echo "com: " . $com->message . '<br>';
                                }
                            }
                            echo $form;
                        }
                    }
                }
            }
        }


        $prev = ($pageStart - 3) < 0 ? 0 : $pageStart - 3;
        $next = $pageStart + 3;
        echo "<a href='index.php?page=galery&pager=$prev'>< prev</a>";
        echo "<a href='index.php?page=galery&pager=$next'>next ></a>";


        ?>

    </div>
</div>
