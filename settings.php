<?php
    $username = "root";
    $password = "";
    $database = new PDO("mysql:host=localhost;dbname=electronics;",$username,$password);

    session_start();
    $user_id = $_SESSION['user_id'];

   
    $user_info = $database->query("SELECT * FROM users WHERE user_id='$user_id'");
    $users = $user_info->fetchAll(PDO::FETCH_ASSOC);

    if(isset($_POST['submit'])){

      $name = $_POST['name'];
      $name = filter_var($name, FILTER_SANITIZE_STRING);
      $email = $_POST['email'];
      $email = filter_var($email, FILTER_SANITIZE_STRING);
   
      $update_profile = $database->prepare("UPDATE `users` SET username = ?, email = ? WHERE user_id = ?");
      $update_profile->execute([$name, $email, $user_id]);
   
      $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
      $prev_pass = $_POST['prev_pass'];
      $old_pass = sha1($_POST['old_pass']);
      $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);
      $new_pass = sha1($_POST['new_pass']);
      $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
      $cpass = sha1($_POST['cpass']);
      $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);
   
      if($old_pass == $empty_pass){
         $message[] = 'please enter old password!';
      }elseif($old_pass != $prev_pass){
         $message[] = 'old password not matched!';
      }elseif($new_pass != $cpass){
         $message[] = 'confirm password not matched!';
      }else{
         if($new_pass != $empty_pass){
            $update_admin_pass = $conn->prepare("UPDATE `users` SET password = ? WHERE id = ?");
            $update_admin_pass->execute([$cpass, $user_id]);
            $message[] = 'password updated successfully!';
         }else{
            $message[] = 'please enter a new password!';
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
    <title>Settings</title>
    <link rel="stylesheet" href="css/settings.css">
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    
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
                <button class=" mx-1 btn  border-0 "><i class="fa-solid fa-bars "></i></button>
          
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
          <?php
            }
          ?>
  </div>
  <ul>
    <li><a href="whishlist.php"><i class="fa-solid fa-heart "></i>Whishlist</a></li>
    <li><a href="cart.php"><i class="fa-solid fa-cart-shopping "></i>MY Cart</a></li>
    <li><a href="myOrders.php"><i class="fa-solid fa-tags "></i>Orders</a></li>
    <li><a href="settings.php"><i class="fa-solid fa-gear "></i>Settings</a></li>
    <li><a href="rating.php"><i class="fa-solid fa-star"></i>Rate this shop</a></li>
    <li><a href="index.php"><i class="fa-solid fa-right-from-bracket"></i>Logout</a></li>
  </ul>
</div>
<div class="card-user">
  <h2>Cart</h2>
  <ul class="listCard">
  </ul>
  <div class="checkOut">
      <div class="total">0</div>
      <div class="closeShopping">Close</div>
  </div>
</div>
<div class="list">

</div>
   
    <div class="settings-page">
        <h1>Settings</h1>
        <div class="info">
          <?php
            foreach ($users as $user) {
          ?>
          <form>
            <label for="full-name">Name:</label>
            <input type="text" name="name" required placeholder="<?php echo $user["username"]; ?>" maxlength="20"  class="box" value="">

            <label for="email">Email:</label>
            <input type="email" name="email" required placeholder="<?php echo $user["email"]; ?>" maxlength="50"  class="box" oninput="this.value = this.value.replace(/\s/g, '')" value="">

            <label for="oldPass">Old Password:</label>
            <input type="password" name="old_pass" placeholder="enter your old password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">

            <label for="newPass">New Password:</label>
            <input type="password" name="new_pass" placeholder="enter your new password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">

            <label for="confirmPass">New Password:</label>
            <input type="password" name="cpass" placeholder="confirm your new password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
            
            <button type="submit"  value="update now" name="submit">Update</button>
          </form>
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