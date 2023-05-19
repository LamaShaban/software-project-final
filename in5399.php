<?php
$username = "root";
$password = "";
$database = new PDO("mysql:host=localhost;dbname=electronics;",$username,$password);
session_start();

if(isset($_SESSION['user_id'])){
  $user_id = $_SESSION['user_id'];
}else{
  $user_id = '';

};

include 'add_to_cart.php';

$product = $database->query("SELECT * FROM products  WHERE product_num = '10'");
$rows = $product->fetchAll(PDO::FETCH_ASSOC);

$user_info = $database->query("SELECT * FROM users WHERE user_id='$user_id'");
$users = $user_info->fetchAll(PDO::FETCH_ASSOC);

if(isset($_POST['addfav'])){
  if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
 }else{
    $user_id = '';
    header('location:user_login.php');
 };
  
    $check_wishlist_numbers = $database->prepare("SELECT * FROM wishlist WHERE product_num = '10' AND user_id = '$user_id' ");
    

      if($check_wishlist_numbers->execute()) {
      if($check_wishlist_numbers->rowCount() > 0){
        echo '<div class="alert alert-warning" role="alert" style="width:500px;       position:fixed;top:80px;left:480px;z-index: 10000000;">
        Already Added To Wishlist !
      </div>
      ';
     }else{
      foreach ($rows as $row)  {
        $product_name = $row['product_name'];
        $product_img = $row['product_img'];
        $price = $row['price'];

        $adddata = $database->prepare("INSERT INTO wishlist (user_id,product_num,product_name,product_img,price) VALUES( '$user_id' ,'10','$product_name','$product_img','$price')");
        $adddata->execute();
        echo '<div class="alert alert-success" role="alert" style="width:500px;       position:fixed;top:80px;left:480px;z-index: 10000000;">
        Added To Wishlist
      </div>
      ';
     }  
    }   
}

}

?>    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>in5399</title>
    <link rel = "stylesheet" href = "css/productPage.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/sidebar.css">
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
                        <a class="nav-link" href="search.html" >Categories</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="home.php" >Reviews</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="home.php" >Contact</a>
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

    <div class = "main-wrapper">
    <div class = "container">
          <?php
            foreach ($rows as $row) {
          ?>
            <div class = "product-div">
                <div class = "product-div-left">
                    <div class = "img-container">
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <img src ="<?php echo $row['product_img']; ?>"alt = "0.5R">
                    </div>  
                </div>
                <div class = "product-div-right">
                    <span class = "product-name"><?php echo $row['product_name']; ?></span>
                    <span class = "product-price"  style="color: #7b988e;font-weight: 400;">Price : $<?php echo $row['price']; ?></span>
                    <p class = "product-description"><?php echo $row['description']; ?></p>
                    <br>
                    <video controls width="350">
                        <source src="vedios/watt res.mp4"type="video/webm">
                       
                    </video>
                    
                    <div class = "btn-groups">
                    <form action="" method="Post">
                               <input type="hidden" name="pid" value="<?= $row['product_num']; ?>">
                              <input type="hidden" name="name" value="<?= $row['product_name']; ?>">
                              <input type="hidden" name="price" value="<?= $row['price']; ?>">
                              <input type="hidden" name="image" value="<?= $row['product_img']; ?>">
                              <button type="submit" value="add to cart" class="add-wishlist-btn" name="add_to_cart"><i class = "fas fa-cart-shopping"></i>add to Cart</button>

                          <button  name="addfav" class="add-wishlist-btn" id="add-to-favorites"><i class = "fas fa-wallet"></i>add to wishlist</button>
                        </form>
                    </div>
                </div>
            </div>
          <?php
            }
          ?>
        </div>
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