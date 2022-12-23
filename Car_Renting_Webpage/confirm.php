<html>
<head>
<link rel="stylesheet" href="css/mycss.css">
<style>
    .confirm_header{
        text-align: center;
    }
    #shopping_cart{
        height: 690px;
    }
    #price_tag{
       position: relative;
       left: 12%;
       background-color: rgb(248, 248, 248);
       width:1260px;
       text-align: center;
       align-self: center;
    }
</style>
</head>

<body>

<div class="header">
    <div id="logo"><a href="index.html" target="_self"><img id="logpic" src="img/logo.png"></a></div>
    <div id="label">Car Rental Center</div>
    <div id="cart"> <a href="cart.php" target="_self" style="text-decoration: none"><button class="cartbutton" role="button">Car Reservation</button></a></div>
</div>

<?php
session_start();
$name = $_POST["first_name"];
$email = $_POST["email"];
$total_price = $_SESSION["Total_price"];
?>

<div class="confirm_header"><strong>Dear <?php echo $name?> Your Order has been confirmed 
<br> Order information is sent to <?php echo $email?></strong>
</div>

<div class="confirm_header"><strong>Your booking summary: </summary></summary></strong></div>

<div id="shopping_cart">
       <table align="center">
       <tr>
       <th style="width:25%">Thumbnail</th>
       <th style="width:25%">Vehicle</th>
       <th style="width:25%">Price Per Day</th>
       <th style="width:25%">Rental Days</th>
       </tr>
      
       <?php
       foreach($_SESSION["cart_item"] as $product){    
       $img_path = "img/".$product[0];
       $car_name = $product[1];
       $car_price = $product[2];
       $quantity = $product[3];
       echo "<tr>
       <td><img src='$img_path' class='cart_img'></td>
       <td>$car_name</td>
       <td>$car_price</td>
       <td>$quantity</td>
       </tr>";
       }?>
       </table>
</div>
<div id="price_tag"><strong>Total Price : $<?php echo $total_price?></strong></div>      

<?php
unset($_SESSION["cart_item"]);
unset($_SESSION["Total_price"]);
session_destroy();
?>

</body>
</html>