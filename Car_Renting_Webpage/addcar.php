<?php

  session_start();
  $match = 0;
   if( !empty($_SESSION["cart_item"]) ){
      //check whether the car is in the session array
       foreach($_SESSION["cart_item"] as $product){
          if($product[0] == $_POST['passedValue'][0] ){
              $match = 1;
              break; 
          }
       }
       if($match == 0){
        array_push($_SESSION["cart_item"], $_POST['passedValue']);
       }
   }else{
    $_SESSION["cart_item"][0] = $_POST['passedValue'];
   }

?>