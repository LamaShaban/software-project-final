<?php

$username = "root";
$password = "";
$database = new PDO("mysql:host=localhost;dbname=electronics;",$username,$password);
session_start();
$user_id = $_SESSION['user_id'];
if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:login.php');
};

$user_info = $database->query("SELECT * FROM users WHERE user_id='$user_id'");
$users = $user_info->fetchAll(PDO::FETCH_ASSOC);

if(isset($_POST['delete'])){
   $cart_id = $_POST['product_num'];
   $delete_cart_item = $database->prepare("DELETE FROM `cart` WHERE product_num = ?");
   $delete_cart_item->execute([$cart_id]);
}

if(isset($_POST['update_qty'])){
   $cart_id = $_POST['product_num'];
   $qty = $_POST['qty'];
   $qty = filter_var($qty, FILTER_SANITIZE_STRING);
   $update_qty = $database->prepare("UPDATE `cart` SET quantity = ? WHERE product_num = ?");
   $update_qty->execute([$qty, $cart_id]);
   echo '<div class="alert alert-primary" role="alert" style="width:500px;       position:fixed;top:80px;left:480px;z-index: 10000000;">
   Already Added To Wishlist !
   </div>
   ';
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>My Cart</title>
</head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="css/owl.carousel.min.css">
<link rel="stylesheet" href="css/all.min.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
<link rel="stylesheet" href="css/wishlist.css">
<link rel="stylesheet" href="css/sidebar.css">
<link rel="stylesheet" href="css/user_cart.css">
<body>
	<header class="header">
        <nav class="navbar navbar-start">
         <div class="container px-5 ">
           <div class="logo d-flex justify-content-center align-items-center">
             <a class="navbar-brand py-1" href="home.php">
               <div class="log-name">
                <div class="d-inline"><i class="fa-solid fa-plug fa-2x"></i></div>
                <span class="go_trip">Electronics</span>
               </div>
              </a>
 
           <div class="menu">
             <div class=" navbar-expand-lg justify-content-between " id="navbarNavDropdown">
               <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="home.php" >Home</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="home.php" >About</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#Contact" >Categories</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="home.php" >Reviews</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#contact" >Contact</a>
                      </li>
                    </div>
                </div>
                </div>
             
                <div class="icon-conect d-flex justify-content-center align-items-center">
                <?php
                    $count_cart_items = $database->prepare("SELECT * FROM `cart` WHERE user_id = ?");
                    $count_cart_items->execute([$user_id]);
                    $total_cart_counts = $count_cart_items->rowCount();
                ?>
                <div class="icon-conect d-flex justify-content-center align-items-center">
                  <button class=" mx-1 btn border-0 shopping ">
                    <a href="cart.php">
                  <i class="fa-solid fa-cart-shopping "></i><span><?= $total_cart_counts; ?></span>
                  </a>
                </button>
                    <button class=" mx-1 btn  border-0 "><a href="whishlist.php"><i class="fa-solid fa-heart"></i></a>
                    </button>
                    <button class=" mx-1 btn  border-0 "><a href="search.php">
                      <i class="fa-solid fa-magnifying-glass "></i>
                    </a></button>
                    <button class=" mx-1 btn  border-0 "><i class="fa-solid fa-bars " id="bttn"></i></button>
                </div>
			
 
               </ul>
             </div>
           
         </div>
       </nav>
     </header>
	
	 <div class="sidebars">
		<div class="cheak"><i  class="fa-solid fa-circle-xmark" id="cancel"></i></div>
      <div class="user">
          <?php
            foreach ($users as $user) {
          ?>
        <div class="user-pic"><img src="<?php echo $user["user_img"]; ?>" alt="" class="user-img"></div>
        <p class="user-name"><?php echo $user["username"]; ?></p>
      </div>
		<ul>
			<li><a href="whishlist.php"><i class="fa-solid fa-heart "></i>Whishlist</a></li>
			<li><a href="cart.php"><i class="fa-solid fa-cart-shopping"></i>MY Cart</a></li>
			<li><a href="myOrders.php"><i class="fa-solid fa-tags "></i>Orders</a></li>
			<li><a href="settings.php"><i class="fa-solid fa-gear "></i>Settings</a></li>
			<li><a href="rating.php"><i class="fa-solid fa-star"></i>Rate this shop</a></li>
			<li><a href="index.php"><i class="fa-solid fa-right-from-bracket"></i>Logout</a></li>
		  </ul>
      <?php
          }
      ?>
	</div>

   <section class="products shopping-cart">

         <h3 class="heading">shopping cart</h3>

         <div class="box-container">

            <?php
               $grand_total = 0;
               $select_cart = $database->prepare("SELECT * FROM `cart` WHERE user_id = '$user_id'");
               $select_cart->execute();
               if($select_cart->rowCount() > 0){
                  while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
            ?>
            <form action="" method="post" class="box">
               <input type="hidden" name="product_num" value="<?= $fetch_cart['product_num']; ?>">
               <img src="<?= $fetch_cart['product_img']; ?>" alt="">
               <div class="name"><?= $fetch_cart['product_name']; ?></div>
               <div class="flex">
                  <div class="price">$<?= $fetch_cart['price']; ?>/-</div>
                  <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="<?= $fetch_cart['quantity']; ?>">
                  <button type="submit" class="fas fa-edit" name="update_qty"></button>
               </div>
               <div class="sub-total"> sub total : <span>$<?= $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?>/-</span> </div>
               <input type="submit" value="delete item" onclick="return confirm('delete this from cart?');" class="delete-btn" name="delete">
            </form>
            <?php
                  $grand_total += $sub_total;
                     }
                  }else{
                     echo '<p class="empty">your cart is empty</p>';
                  }
            ?>
         </div>

         <div class="cart-total">
            <p>grand total : <span>$<?= $grand_total; ?>/-</span></p>
            <a href="search.php" class=" btn option-btn">continue shopping</a>
            <a href="checkout.php" class=" btn btn-checkout <?= ($grand_total > 1)?'':'disabled'; ?>">proceed to checkout</a>
         </div>

   </section>


   

	<footer class="h-50 p-5 bg-dark text-white mt-5" id="Contact">
     <div class="container">
      <div class="container">
        <div class="container">
          <div class="container">
            <div>
              <div class="row d-flex justify-content-between align-item-center">
                <div class="col-3">
                  <h5 class="mx-2" style="color:#ffcc00">CONTACT US</h5>
                  <div class="d-flex ">
                    <i class="fa-solid fa-location-dot mx-2 mt-2 text-muted"></i>
                    <p class="text-muted">Palestine, Gaza, Al-Nasser, Maple Building</p>
                  </div>
                  <div class="d-flex ">
                    <i class="fa-solid fa-phone mx-2 mt-2 text-muted"></i>
                    <p class="text-muted">+(21)-255-999-8888</p>
                  </div>
                  <div class="d-flex ">
                    <i class="fa-solid fa-envelope mx-2 mt-2 text-muted"></i>
                    <p class="text-muted"> Electronics-mail@support.com</p>
                  </div>
                  <div class="social-media d-flex">
                   <div class="bg-secondary bg-opacity-25 rounded  mx-2"> <i class="fa-brands fa-facebook-f p-2 text-muted"></i></div>
                    <div class="bg-secondary bg-opacity-25 rounded  mx-2"><i class="fa-brands fa-twitter p-2 text-muted"></i></div>
                   <div class="bg-secondary bg-opacity-25 rounded  mx-2"> <i class="fa-brands fa-instagram p-2 text-muted"></i></div>
                   <div class="bg-secondary bg-opacity-25 rounded mx-2"><i class="fa-brands fa-google-plus-g p-2 text-muted"></i></div>
                   <div class="bg-secondary bg-opacity-25 rounded  mx-2"><i class="fa-brands fa-linkedin-in p-2 text-muted"></i></div>
                  </div>
                </div>
                <div class="col-2">
                  <h5 class="mx-4" style="color:#ffcc00">CATGORY</h5>
                  <ul>
                    <li class="text-muted list-group-item mt-2"><a href="transistor.php">Transistor</a></li>
                    <li class="text-muted list-group-item mt-2"><a href="diode.php">Diode</a></li>
                    <li class="text-muted list-group-item mt-2"><a href="resistor.php">High voltage resistors</a></li>
                    <li class="text-muted list-group-item mt-2"><a href="Buzzer.php">Buzzers</a></li>
                    <li class="text-muted list-group-item mt-2"><a href="Ics.php">ICs</a></li>
                  </ul>
                </div>
                <div class="col-3">
                </div>
                <div class="col-2">
             
                </div>
            </div>
     <hr class="mt-5">
          <div class="d-flex justify-content-center align-item-center ">
                <p class="text-muted fs-6">© 2023 Elctronics Shop. All rights reserved | Designed by LASED</p>
          </div>
          </div>
        </div>
      </div>
     </div>
   </footer>

         <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
         <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
         <script src="js/main.js"></script>
         <script src="js/jquery.min.js"></script>
         <script src="js/owl.carousel.min.js"></script>
         <script src="js/script.js"></script>
         <script src="js/cart.js"></script>
         <script src="js/bootstrap.bundle.min.js"></script> 
         <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
            </body>

</html>