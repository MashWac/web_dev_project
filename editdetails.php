<?php
require("conn.php");
session_start();
$updateadmin=false;
if(isset($_GET['edit'])){
    $id=$_GET['edit'];
    $result=$conn->query("SELECT * FROM `clientdetails` WHERE clientID='$id'")or die(mysqli_connect_error());
    if($result->num_rows>0){
        $row=$result->fetch_assoc();
        $clientID=$row['clientID'];
        $fName=$row['firstName'];
        $sName=$row['secondName'];
        $password=$row['password'];
        $newlettersub=$row['email'];
    }
}
if(isset($_GET['edit1'])){
    $id=$_GET['edit1'];
    $result=$conn->query("SELECT * FROM `admindetails` WHERE `adminID`=?='$id'")or die(mysqli_connect_error());
    if($result->num_rows>0){
        $updateadmin=true;
        $row=$result->fetch_assoc();
        $clientID=$row['clientID'];
        $fName=$row['firstName'];
        $sName=$row['secondName'];
        $password=$row['password'];
        $newlettersub=$row['email'];
    }
}
?>
<!DOCTYPE html>
<head>
    <title>Edit details</title>
    <meta charset="utf-8">
    <link href="style/styling.css" rel="stylesheet" type="text/css">
   
</head>
<body>
    
    <header>
        <div id="announcement">
            <div id="announce" >
            <span>Amazing deals upto 20% OFF!!<span>
            </div>
        </div>
        <div class="container">
        <a href="homepage.php">
                    <img class="logo" src="logo.png" alt="logo" height="80">
                </a> 
    <nav> <ul>
		<li><a href="homepage.php">HOME</a></li>
        <li><a href="products.php">OUR CATALOG</a></li>
		<li><a href="shippinganddelivery.php">SHIPPING</a></li>
        <li><a href="moneybackguarantee.php">REFUNDS</a></li>
        <li><a href="aboutus.php">ABOUT US</a></li>
        <li><a href="cart.php">
            <span id="cartdetails">Cart<ion-icon name="cart" size="medium"></ion-icon></span></a>
            <?php if(isset($_SESSION['cart'])){
                $count=count($_SESSION['cart']);
                echo"<span id=cartCount>$count</span>";
            }else
             echo"<span id=cartCount>0</span>"
            ?>
            
    </li>
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
            <a class="uoption" href="myorders.php?orders=<?php echo $_SESSION['id'];?>">
            <ion-icon name="basket" class="ordersbasket"></ion-icon> View Orders
            </a>
            </div>
            </li> 
            <li>
            <div id=useroption3>
            <a class="uoption"href="logout.php"><ion-icon name="log-out-outline"></ion-icon> Logout
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
    <form action="insert.php" method="POST" >
    <label for="fname">First Name:</label>
    <input type="text" id="fname" name="firstname" placeholder="First Name" required value=<?php echo $fName;?>><br><br>
    <label for="sname">Second Name:</label>
    <input type="text" id="sname" name="secondname" placeholder="Second Name" required value=<?php echo $sName;?> ><br><br>
    <label for="pass">Password:</label>
    <input type="password" id="pass" name="password" placeholder="Password" value=<?php echo $password;?> required><br><br>
    <label for="cpass">Confirm Password:</label>
    <input type="password" id="cpass" name="cpassword" placeholder="Confirm Password" value=<?php echo $password;?> required><br><br>
    
    <?php if($updateadmin==true):?>
    <label for="adID">Admin ID:</label>
        <input type="number" id="adID" name="adminID" placeholder="adminID" value="" required><br><br>

        <label for="athadmin">Admin ID:</label>
        <input type="number" id="athadmin" name="athorisingadminID" placeholder="Athorising admin" value="" required><br><br>
    <?php else:?>
        <input type="number" hidden id="cliID" name="clientID" value=<?php echo $clientID;?> required><br><br>
        <input type="hidden" id="newsandprom" name="newsandpromotions" value="No"><br><br>
        <label for="newsandprom"><input type="checkbox" id="newsandprom" name="newsandpromotions" value="Yes">Sign up for newsletters and promotions?</label><br><br>
    <?php endif;?>

    <?php if($updateadmin==true):?>
        <input type="submit" name="updateinfo" value="UPDATE Admin details">
    <?php else:?>
    <input type="submit" name="updateclient" value="Update my details">
    <?php endif;?>
</form>
</div>

    <div id="footer">
        <div id="footercontent">
            
        <div id="contactinfo">
            <h4>Contact us on:</h4>
            <p>Tel: 0764535383</p>
            <p>Email:simplycandy@email.com</p>

        </div>
        <div id="address">
            <p>We're located at</p>
            <p>Address: 8th floor Three Towers, Nairobi ,Kenya.</p>
            <p>Opening hours 8am-5pm</p>
        </div>
    </div>
        <div id="footer-bottom">
            &copy; simplycandy.com | Designed by Macharia Wachira
        </div>
    </div>
</div>
<!---ionicons--->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
