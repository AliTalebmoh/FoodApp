<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<div class="sidebar">
  <a href="home.php" class="logo">
    <i class="fas fa-utensils"></i>
    Food<span>Lovers</span>
  </a>
  <nav class="navbar">
    <a href="home.php"><i class="fas fa-home"></i><span>Home</span></a>
    <a href="menu.php"><i class="fas fa-list"></i><span>Menu</span></a>
    <a href="orders.php"><i class="fas fa-shopping-bag"></i><span>Orders</span></a>
    <a href="about.php"><i class="fas fa-info-circle"></i><span>About</span></a>
    <a href="contact.php"><i class="fas fa-envelope"></i><span>Contact</span></a>
  </nav>
</div>

<header class="header">
  <div class="flex">
    <div id="menu-btn" class="fas fa-bars"></div>
    <div class="icons">
      <?php
        $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
        $count_cart_items->execute([$user_id]);
        $total_cart_items = $count_cart_items->rowCount();
      ?>
      <a href="search.php" class="search-btn">
        <i class="fas fa-search"></i>
      </a>
      <a href="cart.php" class="cart-btn">
        <i class="fas fa-shopping-cart"></i>
        <span class="count"><?= $total_cart_items; ?></span>
      </a>
      <div id="user-btn" class="fas fa-user"></div>
    </div>

    <div class="profile">
      <?php
        $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
        $select_profile->execute([$user_id]);
        if($select_profile->rowCount() > 0){
          $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
      ?>
      <p class="name"><?= $fetch_profile['name']; ?></p>
      <div class="flex">
        <a href="profile.php" class="btn">Profile</a>
        <a href="components/user_logout.php" onclick="return confirm('Logout from this website?');" class="delete-btn">Logout</a>
      </div>
      <?php
        } else {
      ?>
      <p class="name">Please login first!</p>
      <a href="login.php" class="btn">Login</a>
      <?php
        }
      ?>
    </div>
  </div>
</header>

