<?php  
class MessagingClass{
    private $con;
    public function __construct($con){
        $this->con=$con;
    }
    public function getAllUserstoMessage($userName){
        try{
            $query = $this->con->prepare("SELECT * from users where userName != '$userName'");
            $query->execute();
            if($query->rowCount()== 0){
                return "";
            }
            else{
                $html="<div class='row' style='background-color:white;padding:20px;'>";

                $html.= "<div class='column' style='background-color:white;'>
                
                <form action='message.php' method='POST'>
                <br><label for='username' style='font-weight: bold'>User Name</label>
                <select name='recipient'>";
                while($row= $query->fetch(PDO::FETCH_ASSOC)){
                    $html.= "<option value='" . $row['userName'] . "'>" . $row['userName'] . "</option>";
                }
                $html.= "</select>";
                $html.= "   
                <br><textarea rows = '7' cols = '90' name = 'msg' placeholder='Type your message'></textarea>
                <br><button type='submit' class='btn btn-secondary' name='messageButton' value='$userName'>Message</button>
                </form>
                ";

                $html.="
                
                <form action='message.php' method='POST'>
                    <br><button type='submit' name='inbox' value='$userName'>Inbox</button>
                    <button type='submit' name='sent' value='$userName'>Sent</button>
                </form>
                
               
                </div></div>";
                 return $html;
            }
        }
        catch(Exception $e){
            echo"Some Error Occured: ".$e->getMessage();
        }
    }
    public function sendMessage($loggedInUserName, $recipient, $msg){
        echo "Message has been delivered";
        $query = $this->con->prepare("INSERT INTO messages(sentBy, sentTo, message) VALUES('$loggedInUserName', '$recipient', '$msg')");
        $query->execute();
    }

    public function viewMessage($loggedInUserName, $var){
        if ($var == 'Sent By'){
            $query = $this->con->prepare("select * from messages where sentTo = '$loggedInUserName'");
            $query1 = $this->con->prepare("select DISTINCT sentBy from messages where sentTo = '$loggedInUserName'");
        }
        else if($var == 'Sent To'){
            $query = $this->con->prepare("select * from messages where sentBy = '$loggedInUserName'");
            $query1 = $this->con->prepare("select  DISTINCT sentTo from messages where sentBy = '$loggedInUserName'");
        }
        $query->execute();
        $query1->execute();
        if($query->rowCount()== 0){
                return "";
        }
        else{

            $html="<div><br>
            <select name='person'>";
            while($row= $query1->fetch(PDO::FETCH_ASSOC)){
                if ($var == 'Sent To'){
                $html.= "<option value='" . $row['sentTo'] . "'>" . $row['sentTo'] . "</option>";
                } 
                else if($var == 'Sent By'){
                $html.= "<option value='" . $row['sentBy'] . "'>" . $row['sentBy'] . "</option>";
                }
            }
            //inbox
            if ($var == 'Sent By'){

            $html.= "</select></div>";
            $html.= "<div>
            <p> View Messages</p>
            <div>
                    <table class='table table-bordered'>
                    <thead class='thead-light'>
                    <tr>
                    <th>Messages</th>
                    <th>Sent By</th>
                    <th>Sent At</th>
                    </tr>
                    </thead>

                    <tbody>";
            while($row=$query->fetch(PDO::FETCH_ASSOC)){
                $sentBy= $row["sentBy"];
                $message= $row["message"];
                $sentAt= $row["sentAt"];

                $html.=  "<tr><td>$message</td>";  
                $html.=  "<td>$sentBy</td>";
                $html.=  "<td>$sentAt</td></tr>";   
            }
            //sent
            } else if ($var == 'Sent To'){

            $html.= "</select></div>";
            $html.= "<div>
            <p> View Messages</p>
            <div>
                    <table class='table table-bordered'>
                    <thead class='thead-light'>
                    <tr>
                    <th>Messages</th>
                    <th>Sent To</th>
                    <th>Sent At</th>
                    </tr>
                    </thead>

                    <tbody>";
            while($row=$query->fetch(PDO::FETCH_ASSOC)){
              

                $sentTo= $row["sentTo"];
                $message= $row["message"];
                $sentAt= $row["sentAt"];

                $html.=  "<tr><td>$message</td>"; 
                $html.=  "<td>$sentTo</td>";
                $html.=  "<td>$sentAt</td></tr>";   
            }
            }
            
            echo $html;
        }
    }
}

