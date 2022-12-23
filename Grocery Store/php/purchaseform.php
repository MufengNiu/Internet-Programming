<!-- This script will show the purchaseform page , asking the user to fill in the details , shown on the topright frame -->
<html>
<head>
<style>
body{
    background-color: #F2F2F2;
}

form{
    display: table;
}

p{
    display: table-row;
}

label,input{
    display: table-row;

}
</style>
</head>

<body>

<?php
//clear shopping cart once order is confirmed
session_start();
$_SESSION["cart_item_temp"] = $_SESSION["cart_item"]; 
unset($_SESSION["cart_item"]);
?>


<div style="text-align: center;"><strong>Please fill out your purchase form<strong><br></div>

<form action="completepurchase.php" target="addorder" method = "post">
<p>
<label for="name">Name:<span style="color:red">*</span></label><input type="text" name="name" id="name" required>
</p>
<p>
<label for="address">Address:<span style="color:red">*</span></label><input type="text" name="address" id="address" required>
</p>
<p>
<label for="suburb">Suburb:<span style="color:red">*</span></label><input type="text" name="suburb" id="suburb" required>
</p>
<p>
<label for="state">State:<span style="color:red">*</span></label><input type="text" name="state" id="state" required>
</p>
<p>
<label for="country">Country:<span style="color:red">*</span></label><input type="text" name="country" id="country" required>
</p>
<p>
<label for="email">Email address:<span style="color:red">*</span></label><input type="email" name="email" id="email" required>
</p>
<p>
<input type="submit" value="Purchase">
</p>

</form>

<script>

//validate form information
function validate(){
    
    if(document.getElementById("name").value==""){
        alert("Please enter your name");
        return false;
    }
    if(document.getElementById("address").value==""){
        alert("Please enter your address");
        return false;
    }
    if(document.getElementById("suburb").value==""){
        alert("Please enter your suburb");
        return false;
    }
    if(document.getElementById("state").value==""){
        alert("Please enter your state");
        return false;
    }
    if(document.getElementById("country").value==""){
        alert("Please enter your country");
        return false;
    }
    var emailcheck = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    if(!document.getElementById("email").value.match(emailcheck)){
        alert("Please input a valid email address");
        return false;
    }
    //refresh shopping cart after form details is confirmed
    var iframe = parent.document.getElementById('frame2');
        iframe.src = iframe.src;
    return true;
}
</script>


</body>
</html>