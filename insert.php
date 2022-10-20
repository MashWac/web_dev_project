<?php
require("conn.php"); 
session_start();
if (isset($_POST['register'])){
$fname=$_POST['first_name'];
$sname=$_POST['surname_name'];
$email=$_POST['email_address'];
$password=$_POST['pass_word'];
$cpassword=$_POST['conpassword'];
$newsletter=$_POST['newsandpromotions'];
$sql_select= "SELECT * FROM `clientdetails` WHERE email='$email' AND`password`='$password';";
$result=$conn->query($sql_select);
        $rows=$result->fetch_assoc();
        if($result->num_rows>0){
            header("location:registration.php");   
        }
        else{
            if($password==$cpassword){
                $sql_insert="INSERT INTO `clientdetails`(`firstName`, `secondName`, `email`, `password`, `newsLetterSignup`) VALUES ('$fname','$sname','$email','$password','$newsletter')";
                if($conn->query($sql_insert)===TRUE){
                    echo"<script>alert('Your details have been recorde!Please login!');
                    window.location.href='loginpage.php';
                    </script>";
            }else{
                echo"<script>alert('Please Try Again!');
                window.location.href='registration.php';
                </script>";
                echo"Error".$conn->error;

            }
        }
    }
}
    if (isset($_POST['updateclient'])){
        $clientID=$_POST['clientID'];
        $fname=$_POST['firstname'];
        $sname=$_POST['secondname'];
        $password=$_POST['password'];
        $newsletterSub=$_POST['newsandpromotions'];
        $sql_update= "UPDATE `clientdetails` SET `firstName`='$fname',`secondName`='$sname',`password`='$password',`newsLetterSignup`='$newsletterSub' WHERE `clientID`='$clientID';";
        if($conn->query($sql_update)===TRUE){
            
            echo"<script>alert('Your information has been updated');
            window.location.href='loginpage.php';
            </script>";;
        }else{
            echo"Error".$conn->error;
        }
    }
session_destroy();

?>

