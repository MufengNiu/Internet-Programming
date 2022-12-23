<html>

<head>
<link rel="stylesheet" href="css/mycss.css">

<style>
#checkoutform{
  position: relative;
  left: 12%;
  background-color: rgb(248, 248, 248);
  width:1260px;
  height: 460px;
  align-self: center;
  text-align: left;
}
.checkout_but{
  position: relative;
  left: 12%;
  background-color: rgb(248, 248, 248);
  width:1260px;
  height: 60px;
  align-self: center;
}

table.checkout{
  table-layout: fixed;
  width: 100%;
  text-align: left;
}
td.input_header{
  text-align: left;
  width: 40%;
}
td.input_data{
  width: 60%;
}
input{
  width: 100%;
}
select{
  width: 100%;
}
.check_left{
  float: left;
}
.check_right{
  float: right;
}
</style>

</head>
<body>

<div class="header">
    <div id="logo"><a href="index.html" target="_self"><img id="logpic" src="img/logo.png"></a></div>
    <div id="label">Car Rental Center</div>
    <div id="cart"> <a href="cart.php" target="_self" style="text-decoration: none"><button class="cartbutton" role="button">Car Reservation</button></a></div>
</div>
 

<div id="checkoutform">
    <p style="text-align:center"><strong>Customer Details and Payment</strong></p>
    <p>Please fill in your details.&nbsp;<span style="color:red">*</span>indicates required field.</p>

   <form method="post" action="confirm.php" target="_self" id="check_form">
   <table class="checkout">
     <tr>
       <td class="input_header"> <label for="first_name">First Name <span style="color:red">*</span></label> </td>
       <td class="input_data"> <input type="text" name="first_name" id="first_name" required> </td>
     </tr>
     <tr>
       <td class="input_header"> <label for="last_name">Last Name <span style="color:red">*</span></label> </td>
       <td class="input_data"> <input type="text" name="last_name" id="last_name" required> </td>
     </tr>
     <tr>
       <td class="input_header"> <label for="email">Email address <span style="color:red">*</span></label> </td>
       <td class="input_data"> <input type="email" name="email" id="email" required> </td>
     </tr>
     <tr>
       <td class="input_header"> <label for="address1">Address Line 1 <span style="color:red">*</span></label> </td>
       <td class="input_data"> <input type="text" name="address1" id="address1" required> </td>
     </tr>
     <tr>
       <td class="input_header"> <label for="address2">Address Line 2 </label> </td>
       <td class="input_data"> <input type="text" name="address2" id="address2" > </td>
     </tr>
     <tr>
       <td class="input_header"> <label for="city">City <span style="color:red">*</span></label> </td>
       <td class="input_data"> <input type="text" name="city" id="city" required> </td>
     </tr>
     <tr>
       <td class="input_header"> <label for="state">State <span style="color:red">*</span></label> </td>

       <td class="input_data"> <select required id="state" name="state"><option selected>New South Wales</option><option>Queensland</option><option>Tasmania</option><option>Victoria</option><option>Western Australia</option></select> </td>
     </tr>
     <tr>
       <td class="input_header"> <label for="post_code">Post Code <span style="color:red">*</span></label> </td>
       <td class="input_data"> <input type="text" name="post_code" id="post_code" required> </td>
     </tr>
     <tr>
       <td class="input_header"> <label for="payment_type">Payment Type <span style="color:red">*</span></label> </td>
       <td class="input_data"> <select required id="payment_type" name="payment_type"><option selected>VISA</option><option>MasterCard</option></select></td>
     </tr>
   </table>
   </form>
</div>

<div class="checkout_but">
    <?php
      session_start();
      $total_price = 0;
      $index = 0;
      $quantity = $_POST["quantity"];
      foreach($_SESSION["cart_item"] as $key => $product){    
        $total_price += $product[2] * $quantity[$index];
        $_SESSION["cart_item"][$key][3] = $quantity[$index];
        $index++;
      } 
      $_SESSION["Total_price"] = $total_price;
    ?>

   <div class="check_left">Your are required to pay $<?php echo $total_price;?> </div>
   <div class="check_right"> <button class="cartbutton" type="submit" form="check_form">Booking</button> </div>
   <div class="check_right"> <a href="index.html" target="_self" style="text-decoration: none"><button class="cartbutton" role="button">Continue Selection</button></a> </div>
   
</div>

</body>
</html>