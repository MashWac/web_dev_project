<?php
session_start();
require("../conn.php");
       
$sql_select= "SELECT * FROM `ordertables` ";
$result=$conn->query($sql_select);

?>
<!DOCTYPE html>
<head>
    <title>Orders</title>
    <meta charset="utf-8">
    <link href="../style/adminstyle.css" rel="stylesheet" type="text/css">
   
</head>
<body>
    
    <header>
        <div class="container">
   
    <nav> <ul>
    <div id="logoImage">
        <a href="adminHome.php">
                    <img class="logo" src="../logo.png" alt="logo" height="80">
                </a> 
            </div>
		<li><a href="adminHome.php">Dashboard</a></li>
        <li><a href="adminDetails.php">Admins</a></li>
		<li><a href="clientDetails.php">Clients</a></li>
        <li><a href="productlisting.php">Products</a></li>
        <li><a href="order.php">Orders</a></li>
        <li><a href="deliveries.php">Delieveries</a></li>
        <?php
            if(!ISSET($_SESSION['logged'])):?>
                <li><a href="registration.php">
                     <input type="submit" id="signup/log" name="signup" value="Signup/login" class="button">
            </a>
         </li>
        <?php else:?>
            <li>
            <div id="userpanel" class=userpane>
                <div id="uname" onclick="userpaneToggle();">
                <ion-icon name="person-circle-outline" size="large"></ion-icon>
                <?php echo $_SESSION['email'];?> 
            <ion-icon class="dropdown" name="caret-down-outline"></ion-icon>
        </div>
        <div class="dropdownoptions">
            <div id="displayuserdetails">
            <?php echo $_SESSION['fname']." ".$_SESSION['sname'];?>
            </div>
            <ul>
                <li>
            <div id=useroption1>
            <a class="uoption" href="editdetails.php?edit=<?php echo $_SESSION['id'];?>">
            <ion-icon name="create-outline" class="editicon"></ion-icon> Edit Profile
            </a>
            </div>
            </li> 
            <li>
            <div id=useroption2>
            <a class="uoption"href="../logout.php"><ion-icon name="log-out-outline"></ion-icon> Logout
            </a> 
            </div>
        </li> 
        </ul>
        </div>
        </div>
        </li>
        <?php endif;?> 
        
    </ul>
    </nav>
</div>
</header>
<div id="mainbody">
    <h2>ALL ORDERS</h2>
<table id="tableadmin" cellpadding="10">
        <thead>
        <tr>
        <th>OrderID</th>
        <th>Date</th>
        <th>Order Details</th>
</tr>
</thead>
<?php
    if($result->num_rows>0){
        while($row=$result->fetch_assoc()){            
        ?>
        <tr>
        <td>
        <?php
        echo $row['orderID'];
        $order_id=$row['orderID'];
        ?>
        </td>
        <td>
        <?php
        echo $row['Date'];?>
        </td>
        <td>
            <table id="tableadmin" cellpadding="10">
                <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $order_select= "SELECT * FROM `orderdetails` WHERE `orderID`='$order_id';";
            $result_order=$conn->query($order_select);
            if($result_order->num_rows>0){
                while($rows=$result_order->fetch_assoc()){
            ?>
                <tr>
                    <td>
                        <?php
                        echo $rows['prodName'];?>
                    </td>
                    <td>
                        <?php
                        echo $rows['orderQuantity'];?>
                    </td>
                    <td>
                        <?php
                        echo $rows['prodPrice'];?>
                    </td>

            <?php
            }
        }
        else{
            echo"Error".$conn->error."<br><br>";
        }   
        ?>
        </table>

        </td>
        </tr>
        <?php
        }
    }
    else{
        echo"Error".$conn->error."<br><br>";
        
    }   
    ?>
</table> 
    </div>
</div>
</div>


<!---ionicons--->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
