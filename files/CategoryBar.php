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

    <div style = 'margin-left: 8px; '>
        <div style="display:flex; font-size: 19px; justify-content: flex-start;">
            <span style="display:flex"><?php echo $category?> Category:&nbsp;&nbsp;&nbsp;</span>
            <div>
                        <a class="btn btn btn-link" href='index.php?page=Home'><b>All</b></a>
                    
                        <a class="btn btn btn-link" href='index.php?page=Home&category=Animal'><b>Animals</b></a>
                    
                        <a class="btn btn btn-link" href='index.php?page=Home&category=Sports'><b>Sports</b></a>
                    
                        <a class="btn btn btn-link" href='index.php?page=Home&category=Human'><b>Human</b></a>
                    
                        <a class="btn btn btn-link" href='index.php?page=Home&category=Other'><b>Others</b></a>
                   
            </div>
        </div>
    </div>
    



<?php
require("MediaOrder.php");
?>