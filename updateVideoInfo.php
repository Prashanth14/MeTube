<?php
require_once("files/connection.php");
require_once("files/main.php");

$vedioId = (int)$_GET['Id'];
$query = $con->prepare("SELECT * FROM media where id = '$vedioId'");
$query->execute();
$row = $query->fetch(PDO::FETCH_ASSOC);
$title = $row["title"];

$description = $row['description'];
$category = $row['category'];
$visibility = $row['privacy'];
$categoryMap = array("Animal" => 0, "Human" => 1, "Sports" => 2, "Other" => 3);
$categoryIndex = $categoryMap[$category];
$categorySelect = array(false, false, false, false);
$categorySelect[$categoryIndex] = true;

$visibilityMap = array("Public" => 0, "Friend" => 1, "Family" => 2, "Fav" => 3);
$visibilityIndex = $visibilityMap[$visibility];
$visibilitySelect = array(false, false, false, false);
$visibilitySelect[$visibilityIndex] = true;

$query = $con->prepare("SELECT keywords FROM media where id = '$vedioId'");
$query->execute();

$keywords = "";
$row = $query->fetch(PDO::FETCH_ASSOC);
$keywords.=$row["keywords"];

$actionString = "updateVideoProcess.php?Id=".$vedioId;
//echo "$actionString";
?>

<form action=<?php echo "$actionString" ?> method="POST" enctype="multipart/form-data">

    <div style="color: red">Edit Media information:</div>

    <div class="form-floating">
        <label for="title">Media Title:</label>
        <textarea class="form-control" name="title" rows = "1"  maxlength="50"
                  placeholder="Enter your title(required)"  id="title" required><?php echo $title ?></textarea>
    </div>
    <br>
    <div class="form-floating">
        <label for="keywords">Keywords:</label>
        <textarea class="form-control" name="keywords" placeholder="Enter keywords list, each keyword separated by ','" id="keywords" ><?php echo $keywords ?></textarea>
    </div>
    <br>
    <div class="parent">
        <!--    <p> Select a category</p>-->
        <div id = 'category'  style="width: 50%;
        float: left;
        padding: 20px;
        border: 2px solid red;">
        <label class="form-label" for="category">
            Select a category:
        </label>
        <div class="form-check">
                <input type="radio" class="form-check-input" name="category" id="Sports" value="Sports" <?php if ($categorySelect[2]) echo "checked"?>>
                <label class="form-check-label" for="Sports">
                    Sports
                </label>
            </div>
            <div class="form-check">
                <input type="radio" class="form-check-input" name="category" id="Animal" value="Animal" <?php if ($categorySelect[0]) echo "checked"?>>
                <label class="form-check-label" for="Animal">
                    Animal
                </label>
            </div>
            <div class="form-check">
                <input type="radio" class="form-check-input" name="category" id="Human" value="Human" <?php if ($categorySelect[1]) echo "checked"?>>
                <label class="form-check-label" for="Human">
                    Human
                </label>
            </div>
            
            <div class="form-check">
                <input type="radio" class="form-check-input" name="category" id="Other" value="Other" <?php if ($categorySelect[3]) echo "checked"?>>
                <label class="form-check-label" for="Other">
                    Other
                </label>
            </div>
        </div>

        

        <div id = 'visibility'  style="width: 50%;
        float: left;
        padding: 20px;
        border: 2px solid red;">
        <label class="form-label" for="visibility">
            Visibility:
        </label>
            <div class="form-check">
                <input type="radio" class="form-check-input" name="visibility" id="Public" value="Public" <?php if ($visibilitySelect[0]) echo "checked"?>>
                <label class="form-check-label" for="Public">
                    Public
                </label>
            </div>
            
            <div class="form-check">
                <input type="radio" class="form-check-input" name="visibility" id="Family" value="Family" <?php if ($visibilitySelect[2]) echo "checked"?>>
                <label class="form-check-label" for="Family">
                    Family
                </label>
            </div>

            <div class="form-check">
                <input type="radio" class="form-check-input" name="visibility" id="Friend" value="Friend" <?php if ($visibilitySelect[1]) echo "checked"?>>
                <label class="form-check-label" for="Friend">
                    Friends
            </label>
            </div>
            
            <div class="form-check">
                <input type="radio" class="form-check-input" name="visibility" id="Fav" value="Fav" <?php if ($visibilitySelect[3]) echo "checked"?>>
                <label class="form-check-label" for="Fav">
                    Favorite
                </label>
            </div>
        </div>
    </div>
    <br>
    <div class="form-floating">
        <label for="floatingTextarea">Description</label>
        <textarea class="form-control" name = 'description' rows="10" cols="50" placeholder="300 characters maximum..." id="floatingTextarea"  maxlength="200"><?php echo $description ?></textarea>
    </div>
    <br>
    <button class="btn btn btn-primary" value="upload" name="upload" type="submit" />Update</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <button class="btn btn btn-secondary" value="cancel" name="cancel" type="submit" />Cancel</button>

</form>
