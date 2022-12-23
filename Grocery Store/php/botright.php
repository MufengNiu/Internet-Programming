<!-- This is the botright frame showing the shopping cart dynamically while the product information is passed from the topright
frame using session -->
<html>
<head>
<style>
table,th,td{
    border: 1px solid black;
    border-collapse: collapse;
}
table{
    width: 100%;
}
tr{
    text-align: center;
}
.header{
    background-color: #f5f3d0;
}
.cartbut{
    width: 140px;
    height: 68px;
}
#cartdisplay{
  overflow: scroll;
  height: 380px;
}
.data{
   background-color:bisque;
}
</style>
</head>
<body>

<?php
session_start();

//Designed for clear-cart and remove product function
if(isset($_REQUEST["action"])){

    //clear cart,unset the cart array
    if( $_REQUEST["action"]  == "clear"){
         unset($_SESSION["cart_item"]);
    }elseif( $_REQUEST["action"]=="remove" && isset($_REQUEST["remove_id"]) ){ 
    //Remove case, traverse the array to remove product with specified product id
        foreach($_SESSION["cart_item"] as $key => $product){   
            //found match
            if($product["id"] == $_REQUEST["remove_id"] ){
                unset($_SESSION["cart_item"][$key]);
                break;
            }
        } 
        //If cart is empty after remove , unset the dimensional array
        if(empty($_SESSION["cart_item"])){
            unset($_SESSION["cart_item"]);
        }
    }
}

$match = 0;  //0 for no match, 1 for found a match
$selected_item = $_SESSION["selected_item"]; //selected item passed from the topright frame
$selected_quantity = $_POST["quantity"]; //select quantity passed from the topright frame

//When cart is empty,just display a simply message
if( !isset($_SESSION["cart_item"]) && $selected_quantity==0 ){
    print("<p align=center>Your Shopping Cart Is Empty</p>");
}else{ ?>

<!-- Below is the case where shopping cart is not empty or the user is add product to the empty cart -->
<?php
//if there is selected item and selected quantity is specified, added product to the dimensional array called $_SESSION["cart_item"]
if( isset($selected_item) && $selected_quantity>0  ){
    //$selected_item is not a associated array
    $item = array( "id"=> $selected_item[0], "name" => $selected_item[1],"quantity"=> $selected_quantity,"unitprice" => $selected_item[2]);

    if(!empty($_SESSION["cart_item"])){
        //check whether the selected product already exist in the cart, just increase quantity if so
        foreach($_SESSION["cart_item"] as $key => $product){
            if($product["name"] == $item["name"] ){
                $_SESSION["cart_item"][$key]["quantity"] = $_SESSION["cart_item"][$key]["quantity"] + $item["quantity"];
                $match = 1; 
                break;
            }
        }
        //if no match, just append to array
        if($match == 0){
            array_push($_SESSION["cart_item"], $item);
        }
    }else{    
         //cart is empty, add the first element to array
         $_SESSION["cart_item"][0] = $item;
    }
}
?>

<p style="text-align: center;"> Your Shopping Cart:<p>
<div id = cartdisplay>
<table>
<tr>
<th class='header'>Name</th>
<th class='header' style="width:18%">Quantity</th>
<th class='header' style="width:18%">Unit Price</th>
<th class='header' style="width:14%">Price</th>
<th class='header' style="width:8%">Remove</th>
</tr>
<!-- <td class='header' style="width:7%">Remove</td> -->
<?php
        // Displaying shopping cart
        $totalprice = 0;
        foreach($_SESSION["cart_item"] as $product){    
            $product_id = $product["id"];
            $product_name = $product["name"];
            $product_quantity = $product["quantity"];
            $product_unitprice = $product["unitprice"];
            $product_price = $product_quantity*$product_unitprice;
            $totalprice = $totalprice + $product_price;
            echo "<tr>
                  <td class='data'>$product_name</td>
                  <td class='data'>$product_quantity</td>
                  <td class='data'>$product_unitprice</td>
                  <td class='data'>$product_price</td>
                  <td style='background-color: white;'><a href='botright.php?action=remove&remove_id=$product_id'><img src='img/bin.png' style='width: 12px;height:20px'></a></td>
                  </tr>";
        }
?>
</table>
</div>
<?php
print("\rTotal Price : $ ".$totalprice);
?>

<br> <!-- clear cart button -->
<a href="botright.php?action=clear">
    <img src="img/clearcart.png" style="float: left" class="cartbut"></img>
</a>

<?php 
//Direct to checkout form ,after checking whether the cart is empty
$cart_length = count($_SESSION["cart_item"]);
print"
<form name='checkout' action='purchaseform.php' target='addorder' onsubmit='return validate($cart_length)'>
    <input type='image' src='img/checkout.png' style='float: right' class='cartbut'>
</form>
";
?>

<!-- End check empty if statement -->
<?php }?>

<!-- Check if cart is empty when the user click checkout -->
<script type="text/javascript">
function validate(cart_length){
    
    if(cart_length == 0){
        alert("cart is empty");
        return false;
    }
    return true;
}
</script>
</body>
</html>