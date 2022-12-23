<!--This is the top right frame showing the product information retrived from database, product id 
is passed from left side through href-->

<html>
<head>
<style>
table,th,td{
    border: 1px solid black;
    border-collapse: collapse;
}

.header{
    background-color: #f5f3d0;
}

.data{
    background-color: bisque;
}

tr{
    text-align:center;
}

.datarow{
    height: 40px;
}

</style>
</head>

<body>
<br>

<?php
print "<table style='width:100%;'>";
print "<tr>";
print "<th class='header'>Product Name</th>";
print "<th class='header'>Unit Price</th>";
print "<th class='header'>Unit Quantity</th>";
print "<th class='header'>In Stock</th>";
print "</tr>";

$product_id = $_REQUEST['product_id'];

if(isset($product_id)){

   session_start();

   $connection = mysqli_connect('localhost', 'uts', 'internet', 'assignment1');
   if(mysqli_connect_errno()){
      printf("Connection to databased failed %s\n" , mysqli_connect_error());
    }
   
    $query_string = "select * from products where product_id = $product_id";
    $result = mysqli_query($connection,$query_string);
    $a_row = mysqli_fetch_row($result);
  
    print "<tr class = 'datarow'>";
    print "\t<td class='data'>$a_row[1]</td>\n";
    print "\t<td class='data'>$a_row[2]</td>\n";
    print "\t<td class='data'>$a_row[3]</td>\n";
    print "\t<td class='data'>$a_row[4]</td>\n";
    print "</tr>";

    $stock = $a_row[4];
  
    //store the product information , and pass it to botright frame using session
    $selected_item = array($a_row[0], $a_row[1].' '.$a_row[3], $a_row[2] );
    $_SESSION["selected_item"] = $selected_item;
}

print "</table>";

if(isset($product_id)){  //check our button
    print" <div align='center'>
    <form name=form1 method='post' action='botright.php' target='checkout' onsubmit='return validate($stock)'>
    <br><label for='quantity'> Select Quantity (max 20) <span style='color:red'>*</span> </label>
    <input type='number' name='quantity' id='quantity' value=1>
    <input type='submit' value='Add to Cart'>
    </form>
    </div>
    ";    
}

?>
<script>
    //this script will validate when quantity selected is more than 0 and less than 20, and it will verify stock left before adding to cart
    function validate(stock_left){
       
       var quantity_selected = document.getElementById("quantity").value;
       
       if(quantity_selected > 20) {
           alert ("Cannot purchase more than 20");
           return false;
       }
       if(quantity_selected <= 0) {
           alert ("Please choose appriorate quantity");
           return false;
       }
       if(quantity_selected > stock_left){
           alert("Not enough Stock");
           return false;
       }
       return true;
    }
</script>
</body>
</html>