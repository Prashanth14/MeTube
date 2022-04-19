<?php 
    require_once("files/main.php"); 
    require_once("files/connection.php");
    require_once("files/Classes/StatusMessage.php");
    require_once("files/Classes/UserAccount.php");

    $emailResult = false;
    $userAccount = new UserAccount($con);

    if(isset($_POST["UpdateEmail"])){
        $email=trim($_POST["email"]);
        $emailResult=$userAccount->updateEmail($email, $loggedInUserName);
    }
    else if(isset($_POST["UpdatePassword"])){
        $currentPassword=$_POST["currentpassword"];
        $newPassword=$_POST["newpassword"];
        $confirmNewPassword=$_POST["confirmnewpassword"];
        $result=$userAccount->updatePassword($currentPassword,$newPassword,$confirmNewPassword,$loggedInUserName);
    }
?>

<!DOCTYPE html>

<html>

    <head>
   <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="style.css"> -->
    <title>Update Profile</title>
    </head>
    <style>
        .container{
  background-color: #fff;
  padding: 5px 30px 20px 30px;
  border-radius: 2px;
}

.container .title{
  font-size: 20px;
  font-weight: 400;
  text-align: center;    
  position: relative;
  padding-top: 10px;        
}

.container .content
form .user-details .input-box{
  margin-top: 10px;
  margin-bottom: 10px;
  position: relative;     
}
form .button{
   height: 45px;
   margin: 25px 0px;   
   text-align: start;
   
 }

 form .button button{
     width:30%;
   border-radius: 15px;
   border: none;
   color: #fff;
   font-size: 18px;
   font-weight: 500;
   letter-spacing: 0.5px;
   background: gray;
 }

 .user-details .input-box input{
  height: 45px;
  width: 100%;
  outline: none;
  font-size: 14px;    
  border-radius: 5px;
  padding-left: 50px;    
  border: 1px solid #ccc;
  border-bottom-width: 2px;
  transition: all 0.3s ease;
  /* background-color: #71b7e6; */
}


    </style>
    <body>     
        <div class="container">
            <div class="title">Edit email & password from your profile</div> <br>
            <div class="content">
                <form action="updateProfile.php" method="POST">

                <div class="user-details">
                        <div class="input-box">
                            <label> Enter an updated email address:</label>
                            <input type="text" name="email" placeholder="New email address">
                            <?php  echo $userAccount->displayError(StatusMessage::$emailInvalidError); ?>
                            <?php echo $userAccount->displayError(StatusMessage::$emailUniqueError); ?>
                        </div>
                        <div class="button">
                            <button type="submit" name="UpdateEmail">Update Email</button>
                        </div>
                    </div>

                    <div class="user-details">
                        <div class="input-box">
                        <label> Enter Old Password</label>
                            <input type="password" name ="currentpassword" placeholder="Old password">
                        </div>
                        <div class="input-box">
                        <label> Enter New Password</label>
                            <input type="password" name ="newpassword" placeholder="New password">
                        </div>

                        <div class="input-box">
                        <label> Enter Confirm New Password</label>
                            <input type="password" name = "confirmnewpassword" placeholder="Confirm new password">

                            <?php echo $userAccount->displayError(StatusMessage::$passwordMatchError); ?>
                            <?php echo $userAccount->displayError(StatusMessage::$passwordLengthError); ?>
                        </div>
                        <div class="button">
                            <button type="submit" name="UpdatePassword">Update Password</button>
                        </div>
                    </div>

                 

                </form>
            </div>
        </div>
     </body> 
</html>
