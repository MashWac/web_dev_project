<?php
require("conn.php");
session_start();

if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(isset($_POST['prodquan'])){
        foreach($_SESSION['cart'] as $key=>$value){
            if($value['product_ID']==$_POST['prod_ID']){
                $_SESSION['cart'][$key]["Quantity"]=$_POST["prodquan"];
               header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
        }
    }
}
if (isset($_POST['checkout'])){
    if(!ISSET($_SESSION['logged'])){
        $clientid=" ";
    }else{
        $clientid=$_SESSION['id'];
    }

    $clientname=$_POST['fullname'];
    $purchaseDate=date('Y-d-m');
    $sqlinsert1="INSERT INTO `ordertables`(`clientID`, `clientname`, `Date`) VALUES ('$clientid', '$clientname','$purchaseDate');";
    if($conn->query($sqlinsert1)){
        $orderId=mysqli_insert_id($conn);
        $sqlinsert2="INSERT INTO `orderdetails`(`orderID`, `productID`, `prodName`, `orderQuantity`, `prodPrice`) VALUES (?,?,?,?,?);";
        $prestmt=mysqli_prepare($conn,$sqlinsert2);

        if($prestmt){
            mysqli_stmt_bind_param($prestmt,"iisii",$orderId,$prodID,$prodname,$prodquantity,$prodPrice);
            foreach($_SESSION['cart']as $key=> $value){
                $prodID=$value['product_ID'];
                $prodPrice=$value['Price'];
                $prodquantity=$value['Quantity'];
                $prodname=$value['prodName'];
                mysqli_stmt_execute($prestmt);
            }
            $deliveryadd=$_POST['address'];
            $delhse=$_POST['houseno'];
            $city=$_POST['city'];
            $tel=$_POST['telephone'];
            $deliverystate="Not Delivered";
            $sqlinsert3="INSERT INTO `deliverydetails`(`orderID`, `deliveryAddress`, `Hseno` , `City`, `telephone`, `deliveryStatus`) VALUES ('$orderId','$deliveryadd','$delhse','$city','$tel','$deliverystate');";
            if($conn->query($sqlinsert3)){
                session_destroy();
                echo"<script>alert('order placed');
                window.location.href='homepage.php';
                </script>";  
    
            }
            else{
                echo"Error".$conn->error;
            }
        }
        else{
            echo"Error".$conn->error;
        }
    }
    else{
        echo"Error".$conn->error;
    }
    
    

}
?>