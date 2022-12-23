<html>
<head>
<link rel="stylesheet" href="css/mycss.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>

<?php
session_start();
if(isset($_REQUEST["action"])){
    if( $_REQUEST["action"]=="clear"){
        unset($_SESSION["cart_item"]);
    }else if( $_REQUEST["action"]=="remove" ){
        $remove_car = $_REQUEST["remove_name"];
        foreach($_SESSION["cart_item"] as $key => $product){    
            if($product[1] == $remove_car ){
                unset($_SESSION["cart_item"][$key]);
                break;
            }
        } 
        if(empty($_SESSION["cart_item"])){
            unset($_SESSION["cart_item"]);
        }
    }
}
?>

<div class="header">
    <div id="logo"><a href="index.html" target="_self"><img id="logpic" src="img/logo.png"></a></div>
    <div id="label">Your Reservation</div>
    <div id="cart"> <a href="cart.php" target="_self" style="text-decoration: none"><button class="cartbutton" role="button">Car Reservation</button></a></div>
</div>

<?php
    if( !isset($_SESSION["cart_item"]) ){ ?>
      
      <div id="shopping_cart" style="text-align:center">You have no reservation</div>
      <div id="cart_button">
      <div id="clear_but"><a href="cart.php?action=clear" target="_self" style="text-decoration: none"><button class="cartbutton" role="button">Clear Cart</button></a></div>
      <div id="payment_but"><button class="cartbutton" role="button" onclick="javascript:alert('No car has been reserved')">Proceed to Payment</button></div>
      </div>
       
    <?php
    }else{?>
       
       <div id="shopping_cart">
       <form method="post" action="checkout.php" target="_self" id="cart_form" onsubmit="return validate()">
       <table>
       <tr>
       <th style="width:20%">Thumbnail</th>
       <th style="width:20%">Vehicle</th>
       <th style="width:20%">Price Per Day</th>
       <th style="width:20%">Rental Days</th>
       <th style="width:20%">Action</th>
       </tr>
      
       <?php
       foreach($_SESSION["cart_item"] as $product){    
       $img_path = "img/".$product[0];
       $car_name = $product[1];
       $car_price = $product[2];
       $car_quantity = (int)$product[3];
        if( $car_quantity == 0){
            $car_quantity = 1;
        }
       echo "<tr>
       <td><img src='$img_path' class='cart_img'></td>
       <td>$car_name</td>
       <td>$car_price</td>
       <td><input type='number' name='quantity[]' value='$car_quantity' required></td>
       <td><a href='cart.php?action=remove&remove_name=$car_name' target='_self'><button class='remove_but' role='button' type='button'>Remove</button></a></td>
       </tr>";
       }?>

       </table>
       </form>
       </div>

       <div id="cart_button">
       <div id="clear_but"><a href="cart.php?action=clear" target="_self" style="text-decoration: none"><button class="cartbutton" role="button">Clear Cart</button></a></div>
       <div id="payment_but"><button class="cartbutton" type="submit" form="cart_form">Proceed to Payment</button></div>
       </div>

<?php }?>


<script>
function validate(){
    var days_array = document.getElementsByName("quantity[]");
    for (var i = 0; i < days_array.length; i++) {
        if(days_array[i].value < 1 ){
            alert("Rental days must be greater than 0");
            return false;
        }
    }
    return true;
}
</script>
</body>
</html>