<?php
require("conn.php");
$email=$_POST['email_address'];
$password=$_POST['pass_word'];
$accounttype=$_POST['account_rad'];
session_start();
$_SESSION['logged']=false;
if(isset($_POST["login"])){
    if (empty('email_address')|| empty($_POST['pass_word'])){
        header("location:loginpage.php");
        exit();
    } else{
        if($accounttype=="customer"){
        $sql_select= "SELECT * FROM `clientdetails` WHERE email='$email' AND`password`='$password';";
        $result=$conn->query($sql_select);
        $rows=$result->fetch_assoc();
        if($result->num_rows ==1){
            $_SESSION['logged']=true;
            $_SESSION ['email']=$email;
            $_SESSION['id']=$rows['clientID'];
            $_SESSION['fname']=$rows['firstName'];
            $_SESSION['sname']=$rows['secondName'];
            echo"<script>alert('Login Successful');
            window.location.href='homepage.php';
             </script>";
            die;   
        }
        else{
            echo"<script>alert('Please enter Valid customer credentials');
            window.location.href='loginpage.php';
            </script>";            
    }  
    }else{
        $sql_select2= "SELECT * FROM `admindetails` WHERE email='$email' AND`password`='$password';";
        $result=$conn->query($sql_select2);
        $rows=$result->fetch_assoc();
        if($result->num_rows ==1){
            
            $_SESSION['logged']=true;
            $_SESSION ['email']=$email;
            $_SESSION['id']=$rows['adminID'];
            $_SESSION['fname']=$rows['firstName'];
            $_SESSION['sname']=$rows['secondName'];
            echo"<script>alert('Login Successful');
            window.location.href='admin/adminHome.php';
             </script>";
            die;   
        }
        else{
            echo"<script>alert('Please enter valid admin credentials');
            window.location.href='loginpage.php';
            </script>";
    }  
    } 
}

} 
  
?>
