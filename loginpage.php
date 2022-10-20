<?php
session_start();
require("conn.php");

?>
<!DOCTYPE html>
<head>
    <title>Login</title>
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
        </div>
        <div id="Logincontent"> 
            <div id="loginformbody">
            <h3>Welcome Back. we've missed you!</h3>
            <form action="confirmlogin.php" method="POST">
                <fieldset>
                    <legend> Login</legend>
                    <div class="inputfield2">
                        <label>Select Account:</label>
                        <label for="admin">Admin:</label>
                        <input type="radio" id="admin" name="account_rad", value="admin" >
                        <label for="customer">Customer:</label>
                        <input type="radio" id="customer" name="account_rad" value="customer"><br><br>
                    </div>
                    <div class="inputfield">
                        <label for="emailadd">Email Address:</label>
                        <input type="email" id="emailadd" name="email_address" required><br><br>
                    </div>
                    <div class="inputfield">
                        <label for="passw">Password:</label>
                        <input type="password" id="passw" name="pass_word" required><br><br>
                    </div>
                        <input type="submit" id="submit_login" name="login" value="LOGIN" class="button">
                </fieldset>
            </form>
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