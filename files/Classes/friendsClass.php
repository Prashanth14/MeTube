<?php
class FriendsClass{
	private $con;
    public function __construct($con){
        $this->con=$con;
    }

    public function getAllUserstoFriend($userName){
        try{
            $query = $this->con->prepare("select * from users where userName != '$userName'");
            $query->execute();
            if($query->rowCount()== 0){
                return "";
            }
            else{
                $html="<div class='row' style='background-color:white;padding:20px;'>";
                $html.= " <div class='column' style='background-color:white;'>
                <div>
                <form action='friend.php' method='POST'>
                <br><label for='username' style='font-weight: bold'>User Name</label>
                <select name='person'>";
                while($row= $query->fetch(PDO::FETCH_ASSOC)){
                    $html.= "<option value='" . $row['userName'] . "'>" . $row['userName'] . "</option>";
                }
                $html.= "</select>
                <p style='font-weight: bold'>Please select your Reationship:</p>
                <input type='radio' id='realtion1' name='relation' value='Friend'>
                <label for='realtion1'>Friend</label><br>
                <input type='radio' id='realtion2' name='relation' value='Family'>
                <label for='realtion2'>Family</label><br>  
                <input type='radio' id='realtion3' name='relation' value='Fav'>
                <label for='realtion3'>Favourite</label><br>
                <button type='submit' name='friendsButton' value='$userName'>Add</button              
                <br><p style='font-weight: bold'>Please select below action for block/unblock contact:</p>
                <input type='radio' id='block' name='block' value='Blocked'>
                <label for='block'>Block</label><br>
                <input type='radio' id='unblock' name='block' value='Not Blocked'>
                <label for='unblock'>Unblock</label><br>  
                <button type='submit' name='blockButton' value='$userName'>Add</button>
                <br></form>
                </div>
                </div>
               
                <div class='column' style='background-color:white;padding:30px'>
           
                <div>
                <table class='table table-bordered'>
                    <thead class='thead-light'>
                    <tr>
                    <th>Username</th>
                    <th>Current Relationship</th>
                    <th>Block Status</th>
                    </tr>
                    </thead>
                <tbody>";
                $contactquery = $this->con->prepare("select * from contact where userName = '$userName'");
                $contactquery->execute();

                while($row = $contactquery->fetch(PDO::FETCH_ASSOC)){
                    $contactUserName = $row['contactUserName'];
                    $contactType = $row['contactType'];
                    $status = $row['status'];

                    $html.="
                    <tr><td>$contactUserName</td>
                        <td>$contactType</td>
                        <td>$status</td></tr>";
                }
                $html.= "</tbody></table></div></div></div>";

                return $html;
            }
        }
        catch(Exception $e){
            echo"Some Error Occured: ".$e->getMessage();
        }
    }
    public function makefriends($userName, $friendName, $relationType){
    	echo "Relationship status with " . $friendName . " changed to ". $relationType;

    	$checkquery = $this->con->prepare("SELECT * from contact where userName='$userName' and contactUserName = '$friendName'");
    	$checkquery->execute();

    	if($checkquery->rowCount()==0){
	    	$query = $this->con->prepare("INSERT INTO contact(userName, contactUserName, contactType) VALUES('$userName', '$friendName', '$relationType')");
	        $query->execute();
	    }
	    else{
	    	$query = $this->con->prepare("UPDATE contact SET contactType = '$relationType' where userName='$userName' and contactUserName = '$friendName'");
	        $query->execute();
    	}
        header("location:friend.php");
    }
    
    public function blockfriends($userName, $friendName, $relationType){
        echo "You have " .$relationType. " user " . $friendName;

        $checkquery = $this->con->prepare("SELECT * from contact where userName='$userName' and contactUserName = '$friendName'");
        $checkquery->execute();

        if($checkquery->rowCount()!=0){
            $query = $this->con->prepare("UPDATE contact SET status = '$relationType' where userName='$userName' and contactUserName = '$friendName'");
            $query->execute();
        }
        else{
            $query = $this->con->prepare("INSERT INTO contact(userName, contactUserName, status) VALUES('$userName', '$friendName', '$relationType')");
            $query->execute();
        }
        header("location:friend.php");
    }

}