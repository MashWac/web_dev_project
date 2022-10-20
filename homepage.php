<?php
session_start();
require("conn.php");
$sql_select= "SELECT * FROM `productdetails` ORDER BY `productClicks` DESC LIMIT 3;";
$result=$conn->query($sql_select);
?>
<!DOCTYPE html>
<head>
    <title>Home</title>
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
    <nav> 
    <ul>
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
    <div id="headline" >
        <h1 id="headlinehead">INDULGE YOUR SWEET TOOTH </h1>
        <p id=headlinebody>Your one stop shop for unique and tasty candy. Endless varieties at your finger tip.😋</p>
    </div>
    <div id="bestsellersheader"> 
        <h1 id="bestsellers">********BEST SELLERS********</h1>
    </div>
    <div id="productdetails">
    <?php
    if($result->num_rows>0){
        while($row=$result->fetch_assoc())

        {
            ?>

        <div class="productdivs">
    
        <?php echo '<img src="data:image;base64,'.base64_encode($row['productImage']).'"alt="prod" width="300" height= "200";">';?>
        <br><br>
        <?php
        echo $row['productName'];?>
        <br><br>
        <?php
        echo "KSH"." ".$row['productPrice'];
        ?>
        <br><br>
        <a href="cart.php?addcart=<?php echo $row['productID'];?> ">
        <button type="submit" id="addtocartpp" name="add_to_cart" class="button">Add to cart<ion-icon name="cart"></ion-icon></button>
        </a>
        </div>
        <?php
        }
    }
    else{
        header("location:homepage.php");
        echo"Error".$conn->error."<br><br>";
        
    }   
    
    ?>
    </div>

    <div id="certification">
        <img id="certification" src="productphotos/certification.png" >
    </div>
     <div id="companydetails">
    <div id="qualityservices">
        <div class="imagepart" id="imagepart1">
            <img id="qualimage" src="productphotos/candiesbasket.jpg" height="400" width="400">
        </div>
        <div class="textpart" id="section1">
        <h2>High quality Service</h2>
        <p>We pride ourselves in providing high quality sugar free products that meet our customers' exquisite tastes. 
            Every bite, lick or suck brings a whole new senstion.
             Trust us our tastebuds will thank you.😉</p>
             <a href="products.php">
            <input type="submit" id="submit_login" name="log" value="VIEW PRODUCTS" class="button">
        </a>
 
        </div>
    </div>
    <div id="delivery">
        <div class="textpart"id="section2">
        <h2>Fast and Efficient delivery</h2>
        <p>We offer fast and efficient delivery to your doorstep.Same day delivery is also available in Nairobi from 6am to 7pm.</p>
        <a href="shippinganddelivery.php">
            <input type="submit" id="submit_login" name="log" value="READ MORE" class="button">
        </a>
    </div>
    <div class="imagepart" id="imagepart2">
        <img id="qualimage" src="productphotos/deliveryt.jpeg" height="400" width="400">
    </div>
    </div>
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