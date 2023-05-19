<?php


if(isset($_SESSION['user_id'])){
  $user_id = $_SESSION['user_id'];
}else{
  $user_id = '';

};


if(isset($_POST['add_to_cart'])){

    if($user_id == ''){
       header('location:login.php');
    }else{
 
       $pid = $_POST['pid'];
       $pid = filter_var($pid, FILTER_SANITIZE_STRING);
       $name = $_POST['name'];
       $name = filter_var($name, FILTER_SANITIZE_STRING);
       $price = $_POST['price'];
       $price = filter_var($price, FILTER_SANITIZE_STRING);
       $image = $_POST['image'];
       $image = filter_var($image, FILTER_SANITIZE_STRING);
 
       $check_cart_numbers = $database->prepare("SELECT * FROM `cart` WHERE product_name = ? AND user_id = ?");
       $check_cart_numbers->execute([$name,$user_id]);
 
       if($check_cart_numbers->rowCount() > 0){
         echo '<div class="alert alert-warning" role="alert" style="width:500px;       position:fixed;top:80px;left:480px;z-index: 10000000;">
         Already Added To Cart !
       </div>
       ';
       }else{

          $insert_cart = $database->prepare("INSERT INTO `cart`(user_id, product_num, product_name, price, product_img) VALUES(?,?,?,?,?)");
          $insert_cart->execute([$user_id, $pid, $name, $price, $image]);
          echo '<div class="alert alert-success" role="alert" style="width:500px;       position:fixed;top:80px;left:480px;z-index: 10000000;">
          Added To Cart
        </div>
        ';
          
       }
 
    }
 
 }
 
 ?>
