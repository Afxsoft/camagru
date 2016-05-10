<?php
?>
<div class="list_b center">
    <div>
        <?php
        $pageStart = !empty($_GET['pager']) ? $_GET['pager'] : 0;
        $images = getAllImage($DBH, $pageStart);
        if(!empty(images)){
            foreach ($images as $image){
                foreach ($image as $key => $value){
                    if($key == 'filtered')
                    {
                        echo "<img src='".$value."'> <a href='#'> liker</a> <a href='#'>commenter</a>";
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
