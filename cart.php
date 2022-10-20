<?php
require("conn.php");
session_start();       
$sql_select= "SELECT `productID`, `productName`,`productDescription`,`productPrice`,`productImage` FROM `productdetails`;";
$result=$conn->query($sql_select);

if(isset($_GET['addcart'])){
    $id=$_GET['addcart'];
    if(isset($_SESSION['cart'])){
        $item_array_id=array_column($_SESSION['cart'],"product_ID");
        if(!in_array($id,$item_array_id)){
            $count=count($_SESSION['cart']);
            $item_array=array('product_ID'=>$id,'Quantity'=>1);
            $_SESSION['cart'][$count]=$item_array; 
            increaseprodclicks($id,$conn); 
            echo"<script>alert('Item has been added to cart');
            window.location.href='products.php';
            </script>";
        }
        else{
            echo"<script>alert('Item is already in cart');
            window.location.href='products.php';
            </script>";

        }
    }else{
        $item_array=array('product_ID'=>$id);
        $_SESSION['cart'][0]=$item_array;
      
    }


}

?>
<!DOCTYPE html>
<head>
    <title>Cart</title>
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
    <div id="cartbody">
    <h3> My Shopping Cart</h3>
    <hr> 
    <div class="orderinfo">
        <h4>Order details</h4>
    
<?php
$totalprice=0;
if(isset($_SESSION['cart'])&&$count!=0){
    ?>
    <table cellpadding="10">
        <thead>
        <tr>
        <th>Product Image</th>
        <th>Product Name</th>
        <th>Product Price</th>
        <th>Product quantity</th>
        <th>Subtotal</th>
        <th>Product options</th>
        
</tr>
</thead>
<?php
    $item_array_id=array_column($_SESSION['cart'],"product_ID");

    if($result->num_rows>0){
        while($row=$result->fetch_assoc())
        foreach($_SESSION["cart"]as $key=>$value){
            if($row['productID']==$value['product_ID']){
                $currentquan=$value['Quantity'];
                $_SESSION['cart'][$key]["prodName"]=$row['productName'];
                $_SESSION['cart'][$key]["Price"]=$row['productPrice'];
            ?>
            <tr>
                <td>
                    <?php 
                    echo '<img src="data:image;base64,'.base64_encode($row['productImage']).'"alt="prod" width="100" height= "100";">';?>
                </td>
                <td>
                    <?php
                    echo $row['productName'];?>
                </td>
                <td>
                    <?php
                    echo "KSH".$row['productPrice'];
                    ?>
                    <input type='hidden' class='pprice' value="<?php echo (intval($row['productPrice']))?>">
                    
                </td>
                <td>
                    <form action="processorder.php" method="POST">
                     <input type="number" class="pquantity" onchange="this.form.submit()" name="prodquan" value="<?php echo ($currentquan); ?>" min="1" max="8">
                     <input type='hidden'  name="prod_Price" value="<?php echo ($row['productPrice'])?>">
                     <input type='hidden'  name="prod_Name" value="<?php echo ($row['productName'])?>">
                     <input type='hidden'  name="prod_ID" value="<?php echo ($row['productID'])?>">
                    </form>
                    
                </td>
                <td class="ptotal">

                </td>
                <td>
                    <a href="conn.php?delete3=<?php echo $row['productID'];?>">
                    <button type="button" class="btndel"> <ion-icon name="trash-outline" class="deleteicon"> </ion-icon> DELETE</button>
                </a>
            </td>
        </tr>
        <?php
        }
        
    }
}
    
else{
        header("location:homepage.php");
        echo"Error".$conn->error."<br><br>";
        
    }  
}
else {echo "<h4> Cart is empty</h4>";
}
    ?>
            
    </table>
</div>
<div id=pricingdetails>
    <h3> Order Summary</h3>
    <hr>
    <h4>Total items</h4>
    <?php
    if(isset($_SESSION['cart'])){
        echo"<h5> Price ($count items)</h5>";
    }
    else{
        echo"<h5> Price (0 items)</h5>";
    }
    ?>
    <h4>Delivery Charges</h4>
    <?php if(!ISSET($_SESSION['logged'])):?>
        <h5>KSH200</h5>
    <?php else:?>
        <h5> FREE</h5>
    <?php endif;?>
    <h4> Amount Payable:</h4>
    <h4 id="gtotal">
    </h4>

</div>
<br><br>
<div deliveryDetails>
    <form method="POST" action="processorder.php">
        <fieldset>
        <legend>DELIVERY DETAILS</legend>
    <?php
     if(!ISSET($_SESSION['logged'])):?>
    <label for="fulname">Full Names:</label>
    <input type="text" name="fullname" id="fulname" placeholder="Enter Your Fullnames" required><br><br>
    <?php else:?>
    <label for="fulname">Full Names:</label>
    <input type="text" name="fullname" id="fulname" value="<?php echo $_SESSION['fname']." ".$_SESSION['sname'];?>" readonly><br><br>
    <?php endif;?> 

    <label for="add">Delivery Address:</label>
    <input type="text" name="address" id="add" placeholder="Enter Delivery Address" required><br><br>
    <label for="hseno">House number:</label>
    <input type="text" name="houseno" id="hseno" placeholder="Enter House Number" required><br><br>
    <label for="cit">City:</label>
    <input type="text" name="city" id="cit" placeholder="Enter City" required><br><br>
    <label for="tel">Telephone:</label>
    <input type="text" name="telephone" id="tel" placeholder="Enter Phone Number" required><br><br>
    <a href="cart.php?addcart=<?php echo $row['productID'];?> ">
        <button type="submit" id="cout" name="checkout" class="button">Checkout<ion-icon name="cart"></ion-icon></button>
    </a>
    <br><br>
</fieldset>
</form>
<a href="products.php">
    <button type="submit" id="conshopping" name="continueshopping" class="button">Continue Shopping</button>
 </a>
    </div>
</div>



<!---ionicons--->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script>
    var gt=0;
    var pprice=document.getElementsByClassName('pprice');
    var pquantity=document.getElementsByClassName('pquantity');
    var ptotal=document.getElementsByClassName('ptotal');
    var gtotal=document.getElementById('gtotal');

    function subTotal(){
        gt=0;
        for(i=0;i<pprice.length;i++){
            ptotal[i].innerText=(pprice[i].value)*(pquantity[i].value);
            gt=gt+((pprice[i].value)*(pquantity[i].value));
          
        }
        <?php if(!ISSET($_SESSION['logged'])):?>
            gt=gt+200;
            <?php endif;?>   
        gtotal.innerText=gt;
    }
    subTotal();
</script>
</div>
</body>
</html>
