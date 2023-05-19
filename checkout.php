<?php
$username = "root";
$password = "";
$database = new PDO("mysql:host=localhost;dbname=electronics;",$username,$password);

session_start();
$user_id = $_SESSION['user_id'];



if(isset($_POST['order'])){

  $name = $_POST['name'];
  $name = filter_var($name, FILTER_SANITIZE_STRING);
  $number = $_POST['number'];
  $number = filter_var($number, FILTER_SANITIZE_STRING);
  $email = $_POST['email'];
  $email = filter_var($email, FILTER_SANITIZE_STRING);
  $method = $_POST['method'];
  $method = filter_var($method, FILTER_SANITIZE_STRING);
  $address = 'flat no. '. $_POST['flat'] .', '. $_POST['street'] .', '. $_POST['city'] .', '. $_POST['state'] .', '. $_POST['country'] .' - '. $_POST['pin_code'];
  $address = filter_var($address, FILTER_SANITIZE_STRING);
  $total_products = $_POST['total_products'];
  $total_price = $_POST['total_price'];

  $check_cart = $database->prepare("SELECT * FROM `cart` WHERE user_id = ?");
  $check_cart->execute([$user_id]);

  if($check_cart->rowCount() > 0){

     $insert_order = $database->prepare("INSERT INTO `orders`(user_id, username, number, email, method, address, total_products, total_price) VALUES(?,?,?,?,?,?,?,?)");
     $insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $total_price]);

     $delete_cart = $database->prepare("DELETE FROM `cart` WHERE user_id = ?");
     $delete_cart->execute([$user_id]);

     $message[] = 'order placed successfully!';
  }else{
     $message[] = 'your cart is empty';
  }

}
$user_info = $database->query("SELECT * FROM users WHERE user_id='$user_id'");
$users = $user_info->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check out</title>
    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/payment.css">
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <style>
      .hero form{
          margin-top: 100px;
          background: #ffcc006e;
          width:60%;
          margin-left:20%;
          padding: 20px 50px;
          border-radius:15px;
      }
      .hero form h3{margin-bottom:15px; margin-top:15px;}
      .hero form .display-orders{
        border:2px dashed #ffcc00;
        padding:30px;
        font-size:18px;
        font-weight:500;
      }
      .hero form .flex{
        background:#ffffff52;
        padding: 20px 30px;
        border-radius:15px;
        font-size:18px;
      }
      .btn-palce-order{
        width:250px;height:48px;
        text-align:center;
        margin-left:250.725px;
        font-weight:500;
        font-size:18px;
        border:none;
        cursor:pointer;
        border-radius:5px;
      }
      form .btn-palce-order:hover{background:#ffcc006e;color:#000;}
    </style>
</head>
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
                        <a class="nav-link" href="#Contact" >Contact</a>
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
                    <button class=" mx-1 btn  border-0 "><a href="search.php"><i class="fa-solid fa-magnifying-glass "></i></a></button>
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
            <li><a href="cart.php"><i class="fa-solid fa-cart-shopping "></i>MY Cart</a></li>
            <li><a href="myOrders.php"><i class="fa-solid fa-tags "></i>Orders</a></li>
            <li><a href="settings.php"><i class="fa-solid fa-gear "></i>Settings</a></li>
            <li><a href="rating.php"><i class="fa-solid fa-star"></i>Rate this shop</a></li>
            <li><a href="index.php"><i class="fa-solid fa-right-from-bracket"></i>Logout</a></li>
          </ul>
          <?php
            }
          ?>
	</div>


<div class="hero">

<form action="" method="POST">

<h3 class="">your orders</h3>

   <div class="display-orders">
   <?php
      $grand_total = 0;
      $cart_items[] = '';
      $select_cart = $database->prepare("SELECT * FROM `cart` WHERE user_id = ?");
      $select_cart->execute([$user_id]);
      if($select_cart->rowCount() > 0){
         while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
            $cart_items[] = $fetch_cart['product_name'].' ('.$fetch_cart['price'].' x '. $fetch_cart['quantity'].') - ';
            $total_products = implode($cart_items);
            $grand_total += ($fetch_cart['price'] * $fetch_cart['quantity']);
   ?>
      <p> <?= $fetch_cart['product_name']; ?> <span>(<?= '$'.$fetch_cart['price'].' / Number of Items :  '. $fetch_cart['quantity']; ?>)</span> </p>
   <?php
         }
      }else{
         echo '<p class="empty">your cart is empty!</p>';
      }
   ?>
      <input type="hidden" name="total_products" value="<?= $total_products; ?>">
      <input type="hidden" name="total_price" value="<?= $grand_total; ?>" value="">
      <div class="grand-total ">Total Price : <span>$<?= $grand_total; ?></span></div>
   </div>

   <h3>place your orders</h3>

   <div class="flex">
      <div class="inputBox my-4">
         <span>your name :</span>
         <input type="text" name="name" placeholder="enter your name" class="box form-control" maxlength="20" required>
      </div>
      <div class="inputBox my-4">
         <span>your number :</span>
         <input type="number" name="number" placeholder="enter your number" class="box form-control" min="0" max="9999999999" onkeypress="if(this.value.length == 10) return false;" required>
      </div>
      <div class="inputBox my-4">
         <span>your email :</span>
         <input type="email" name="email" placeholder="enter your email" class="box form-control" maxlength="50" required>
      </div>
      <div class="inputBox my-4">
         <span>payment method :</span>
         <select name="method" class="box form-control" required>
            <option value="cash on delivery">cash on delivery</option>
            <option value="credit card">credit card</option>
            <option value="paytm">paytm</option>
            <option value="paypal">paypal</option>
         </select>
      </div>
      <div class="inputBox my-4">
         <span>address line 01 :</span>
         <input type="text" name="flat" placeholder="e.g. flat number" class="box form-control" maxlength="50" required>
      </div>
      <div class="inputBox my-4">
         <span>address line 02 :</span>
         <input type="text" name="street" placeholder="e.g. street name" class="box form-control" maxlength="50" required>
      </div>
      <div class="inputBox my-4">
         <span>city :</span>
         <input type="text" name="city" placeholder="e.g. mumbai" class="box form-control" maxlength="50" required>
      </div>
      <div class="inputBox my-4">
         <span>state :</span>
         <input type="text" name="state" placeholder="e.g. maharashtra" class="box form-control" maxlength="50" required>
      </div>
      <div class="inputBox my-4">
         <span>country :</span>
         <input type="text" name="country" placeholder="e.g. India" class="box form-control" maxlength="50" required>
      </div>
      <div class="inputBox my-4">
         <span>pin code :</span>
         <input type="number" min="0" name="pin_code" placeholder="e.g. 123456" min="0" max="999999" onkeypress="if(this.value.length == 6) return false;" class="box form-control" required>
      </div>
   </div>

   <input type="submit" name="order" class="btn-palce-order my-3 <?= ($grand_total > 1)?'':'disabled'; ?>" value="place order" style="background:#ffcc00;color:#fff;">

</form>

</div>    

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

    <script src="js/script.js"></script>
    <script src="js/main.js"></script>
    <script src="js/cart.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script> 
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
</body>
</html>