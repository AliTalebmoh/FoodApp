<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/add_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>category</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="products">

   <h1 class="title">food category</h1>

   <div class="box-container">

   <?php
   // Get category name from query string
   $category = isset($_GET['category']) ? $_GET['category'] : '';

   // Fetch products based on the category name
   $select_products = $conn->prepare("
      SELECT 
         products.id, 
         products.name, 
         products.price, 
         products.image 
      FROM 
         products
      INNER JOIN 
         categories 
      ON 
         products.category_id = categories.id 
      WHERE 
         categories.name = ?
   ");
   $select_products->execute([$category]);

   // Check if products exist for the category
   if($select_products->rowCount() > 0){
      while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
?>
<form action="" method="post" class="box">
   <input type="hidden" name="pid" value="<?= htmlspecialchars($fetch_products['id']); ?>">
   <input type="hidden" name="name" value="<?= htmlspecialchars($fetch_products['name']); ?>">
   <input type="hidden" name="price" value="<?= htmlspecialchars($fetch_products['price']); ?>">
   <input type="hidden" name="image" value="<?= htmlspecialchars($fetch_products['image']); ?>">
   <a href="quick_view.php?pid=<?= htmlspecialchars($fetch_products['id']); ?>" class="fas fa-eye"></a>
   <button type="submit" class="fas fa-shopping-cart" name="add_to_cart"></button>
   <img src="products-imgs/<?= htmlspecialchars($fetch_products['image']); ?>" alt="<?= htmlspecialchars($fetch_products['name']); ?>">
   <div class="name"><?= htmlspecialchars($fetch_products['name']); ?></div>
   <div class="flex">
      <div class="price"><span>$</span><?= htmlspecialchars($fetch_products['price']); ?></div>
      <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
   </div>
</form>
      <?php
            }
         }else{
            echo '<p class="empty">no products added yet!</p>';
         }
      ?>

   </div>

</section>

















<?php include 'components/footer.php'; ?>


<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>


</body>
</html>