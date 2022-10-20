<?php

$conn=mysqli_connect("localhost","Macharia","i*HCBmyZdL]2nk5","food_project");
if(!$conn){
    die("Not connected".mysqli_connect_error());

}
if(isset ($_GET['delete'])){
    $id=$_GET['delete'];
    $conn->query("DELETE FROM `clientdetails` WHERE clientID='$id'")or die(mysqli_connect_error());
    echo"<script>alert('Client has been removed from database ');
    window.location.href='admin/clientDetails.php';
    </script>";
}
if(isset ($_GET['delete1'])){
    $id=$_GET['delete1'];
    $conn->query("DELETE FROM `admindetails` WHERE adminID='$id'")or die(mysqli_connect_error());
    echo"<script>alert('Admin has been removed from database ');
    window.location.href='admin/adminDetails.php';
    </script>";
}
if(isset ($_GET['delete2'])){
    $id=$_GET['delete2'];
    $conn->query("DELETE FROM `productdetails` WHERE productID='$id'")or die(mysqli_connect_error());
    echo"<script>alert('Product has been removed from database ');
    window.location.href='admin/productlisting.php';
    </script>";
}
if(isset ($_GET['delete3'])){
    session_start();
    $id=$_GET['delete3'];
    foreach($_SESSION['cart'] as $key=>$value){
        if($value['product_ID']==$id){
            unset($_SESSION['cart'][$key]);
            echo"<script>alert('Item is has been removed from cart');
            window.location.href='cart.php';
            </script>";
        }
    }
            
}
if(isset ($_GET['edit5'])){
    $id=$_GET['edit5'];
    $delivered="delivered";
    $conn->query("UPDATE `deliverydetails` SET `deliveryStatus`='$delivered' WHERE `deliveryID`=$id")or die(mysqli_connect_error());
    echo"<script>alert('Delivery Status has been changed');
    window.location.href='admin/deliveries.php';
    </script>";
}
function increaseprodclicks($prodID,$conn){
    $sql_selectprod= "SELECT * FROM `productdetails` WHERE `productID`='$prodID'";
    $result1=$conn->query($sql_selectprod);
    if($result1->num_rows>0){
        while($row1=$result1->fetch_assoc()){
            $currentclicks=intval($row1['productClicks']);
        }
        $currentclicks=$currentclicks+1;
    
    $sql_updatenewclicks="UPDATE `productdetails` SET `productClicks`='$currentclicks' WHERE `productID`='$prodID'";
    if($conn->query($sql_updatenewclicks)===TRUE){
        echo"<script>alert('Number of clicks have been increased');
        </script>";   
    }else{
        echo"Error".$conn->error;
    }
}
else{
    echo"Error".$conn->error;
}


}
    
?>

<script>
    function userpaneToggle(){
        const togglepanel=document.querySelector('.dropdownoptions');
        togglepanel.classList.toggle('active');
    }
</script>