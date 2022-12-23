<!-- This script will update databse and display order confirmation information after order is confirmed,Shown in the topright frame-->
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
.data{
   background-color: bisque;
}
#invoice{
  position: relative;
  overflow: scroll;
  height: 225px;
}
</style>
</head>

<body>

<p style="text-align: center;"><strong>Your order is confirmed</strong></p>
<p style="text-align: center;">Invoice:&nbsp</p> 

<div id="invoice">
<table>
<tr>
<th class='header'>Name</th>
<th class='header' style="width:18%">Quantity</th>
<th class='header' style="width:18%">Unit Price</th>
<th class='header' style="width:14%">Price</th>
</tr>
<!-- <td class='header' style="width:7%">Remove</td> -->

<?php
session_start();

$connection = mysqli_connect('localhost','uts','internet','assignment1');
if(mysqli_connect_errno()){
    printf("Connection to database failed %s\n",mysqli_connect_error());
}

$totalprice = 0;
foreach($_SESSION["cart_item_temp"] as $product){    

    $product_id = $product["id"];
    $product_name = $product["name"];
    $product_quantity = $product["quantity"];
    $product_unitprice = $product["unitprice"];
    $product_price = $product_quantity*$product_unitprice;
    $totalprice = $totalprice + $product_price;

    $check_query = "select in_stock from products where product_id = $product_id";
     
    //GET previous result
    $check_result = mysqli_fetch_row(mysqli_query($connection,$check_query));
    $new_stock = $check_result[0] - $product_quantity; 
    //update new stock
    $update_query = "update products set in_stock = $new_stock where product_id = $product_id";
    
    if( !$update_result = mysqli_query($connection,$update_query)){
        echo "Database update failed\n";
    }
    //print invoice
    echo "<tr>
                  <td class='data'>$product_name</td>
                  <td class='data'>$product_quantity</td>
                  <td class='data'>$product_unitprice</td>
                  <td class='data'>$product_price</td>
         </tr>";
}
unset($_SESSION["cart_item_temp"]);
?>

</table>
</div>

<?php
print("\rTotal Price : $ ".$totalprice);
?>
<!-- go back to product information page after click button -->
<div style="float: right;"><a href="topright.php" target="addorder"><button>Continue Shopping</button></a></div>

</body>
</html>