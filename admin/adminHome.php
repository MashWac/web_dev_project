<?php
require("../conn.php");
?>
<!DOCTYPE html>
<head>
    <title>Admin Home</title>
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
                <li><a href="../loginpage.php">
                     <input type="submit" id="adminlog" name="adminLogin" value="Login" class="button">
            </a>
         </li>
        <?php else:?>
            <div id="userpanel">
            <div id="uname" onclick="userpaneToggle();">
        <li><ion-icon name="person-circle-outline" size="large"></ion-icon>
        <?php echo $_SESSION['email'];?> 
        <ion-icon class="dropdown" name="caret-down-outline"></ion-icon>
    </li>
        </div>
        <div class="dropdownoptions">
            <div id="displayuserdetails">
            <?php echo $_SESSION['fname']." ".$_SESSION['sname'];?>
            </div>
            <ul>
                <li>
            <div id=useroption1>
            <a class="uoption" href="../editdetails.php?edit1=<?php echo $_SESSION['id'];?>">
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
        <?php endif;?> 
    </ul>	
</nav>
</div>
</header>
<div id="mainbody">
    <div id="adminHome">
    <section>
        <h1> Welcome back</h1>
        <div class="Accordion">
        <h2>What would you like to do today?</h2>
        <div class=Accorcionitem id="option1">

            <a class="accordionlink" href=#option1>View clients
                <ion-icon class=ion-icon name="add-outline"></ion-icon>
                <ion-icon class=ion-icon name="remove"></ion-icon>
            </a>
            <div class="answer">
                <p>View a list of the clients registered on the database.<br><br>   <a href="clientDetails.php">
            <input type="submit" id="gotoclients" name="goclients" value="View Clients" class="buttonadminHome">
        </a></p>
            </div>
        </div>
        <div class=Accorcionitem id="option2">
            <a class="accordionlink" href=#option2>View orders
                <ion-icon class=ion-icon name="add-outline"></ion-icon>
                <ion-icon class=ion-icon name="remove"></ion-icon>
            </a>
            <div class="answer">
                <p>View a list of the all orders.<br><br>   <a href="order.php">
            <input type="submit" id="gotoorder" name="goorders" value="View Orders" class="buttonadminHome">
        </a></p>
            </div>
        </div>
        <div class=Accorcionitem id="option3">
            <a class="accordionlink" href=#option3>View Deliveries
                <ion-icon class=ion-icon name="add-outline"></ion-icon>
                <ion-icon class=ion-icon name="remove"></ion-icon>
            </a>
            <div class="answer">
                <p>View a list of the Deliveries that have been made.<br><br>   <a href="deliveries.php">
            <input type="submit" id="gotodeliveries" name="godeliveries" value="View Deliveries" class="buttonadminHome">
        </a></p>
            </div>
        </div>
        <div class=Accorcionitem id="option4">
            <a class="accordionlink" href=#option4>View Products
                <ion-icon class=ion-icon name="add-outline"></ion-icon>
                <ion-icon class=ion-icon name="remove"></ion-icon>
            </a>
            <div class="answer">
                <p>View a list all of the products.<br><br>   <a href="productlisting.php">
            <input type="submit" id="gotoproducts" name="goproducts" value="View Products" class="buttonadminHome">
        </a></p>
            </div>
        </div>
        <div class=Accorcionitem id="option5">
            <a class="accordionlink" href=#option5>Register new admin
                <ion-icon class=ion-icon name="add-outline"></ion-icon>
                <ion-icon class=ion-icon name="remove"></ion-icon>
            </a>
            <div class="answer">
                <p>Register a new Admin.<br><br>  
                 <a href="registerAdmin.php">
                     <input type="submit" id="gotoregisteradmin" name="goregadmin" value="RegisterAdmin" class="buttonadminHome">
                    </a>
                </p>
            </div>
        </div>
        <div class=Accorcionitem id="option6">
            <a class="accordionlink" href=#option6>View Staff
                <ion-icon class=ion-icon name="add-outline"></ion-icon>
                <ion-icon class=ion-icon name="remove"></ion-icon>
            </a>
            <div class="answer">
                <p>View Staff details.<br><br>  
                 <a href="adminDetails.php">
                     <input type="submit" id="gotostaffdetails" name="gostaffdets" value="View Staff" class="buttonadminHome">
                    </a>
                </p>
            </div>
        </div>
     </div>
</section>
    </div> 
</div>
</div>
<!---ionicons--->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
