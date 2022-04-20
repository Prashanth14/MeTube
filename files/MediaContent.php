<?php
    if(isset($_GET["page"])){
        $page = $_GET["page"];
    }

    if(isset($_GET["category"])){
        $category = $_GET["category"];
    }

    if ($category == "All") {
        $category = "";
    }

    if(isset($_GET["sortby"])){
        $sortby = $_GET["sortby"];
    }

    if(isset($_GET["keywords"])){
        $keywords = $_GET["keywords"];
    }
    $size = "";
    if(isset($_GET["size"])){
        $size = $_GET["size"];
    }
?>

<div class='videoSection' >

    <?php
        $mediaGrid= new MediaGrid($con);
        echo $mediaGrid->create($page, $category, $keywords, $sortby, $loggedInUserName, $size);
    ?>
</div>