<?php
require_once("connection.php");
require_once("Classes/UserDetails.php");
require_once("Classes/Media.php");
require_once("Classes/MediaGrid.php");
require_once("Classes/MediaItem.php");
if(isset($_GET["category"])){
    $category = $_GET["category"];
} else {
    $category = "All";
}
?>

<div>
    <div style="display:flex; font-size: 19px; justify-content: flex-start">
        <span style="display:flex"><?php echo $category?> Category: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
        <div>
            <a class="btn btn btn-dark" href='index.php?page=Home'>All</a>
            <a class="btn btn btn-dark" href='index.php?page=Home&category=Animal'>Animals</a>
            <a class="btn btn btn-dark" href='index.php?page=Home&category=Sports'>Sports</a>
            <a class="btn btn btn-dark" href='index.php?page=Home&category=Human'>Human</a>
            <a class="btn btn btn-dark" href='index.php?page=Home&category=Other'>Others</a>
        </div>
    </div>
</div>

<?php
require("MediaOrder.php");
?>
