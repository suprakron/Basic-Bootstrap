<?php
session_start();
error_reporting(E_ALL);
include('config.php');

$msg = '';
if (isset($_GET['add'])) {
  if (isset($_SESSION['user'])) {
    $productid = $_GET['add'];
    $user = $_SESSION['user'];
    $sql = "INSERT INTO cart(productid,user) VALUES(:productid,:user)";
    $query = $db->prepare($sql);
    $query->bindParam(':productid', $productid, PDO::PARAM_STR);
    $query->bindParam(':user', $user, PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $db->lastInsertId();
    if ($lastInsertId) {
      $msg = '<div id="msg" class="alert alert-success"><strong>Product Added To Cart</strong></div>';
    } else {
      $msg = '<div id="msg" class="alert alert-danger"><strong>Unable To Add</strong></div>';
    }
  } else {
    echo "<script type='text/javascript'> document.location = 'login.php'; </script>";
  }
} else {
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>E-shopping</title>
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="./css/style.css">
  <script>
    if (typeof window.history.pushState == 'function') {
      window.history.pushState({}, "Hide", '<?php echo $_SERVER['PHP_SELF']; ?>');
    }
  </script>
</head>

<body>

  <section>
    <?php include('./inc/header.php'); ?>

    <?php include('./inc/carousel.php'); ?>

    <div class="container mt-5 my-section">
      <h3 class="py-4">Popular Products</h3>
      <div class="msg"><?php echo $msg; ?></div>
      <div class="row">

        <?php

        // FECTH PRODUCTS
        $sql = "SELECT * from products ORDER BY RAND() LIMIT 4";
        $query = $db->prepare($sql);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);

        if ($query->rowCount() > 0) {
          foreach ($results as $result) {        ?>
          
            <div class="col-lg-3 col-md-6 mb-4">
              <div class="card h-100">
                <a href="#"><img class="card-img-top" src="./img/products/<?php echo $result->img; ?>" alt="<?php echo $result->title; ?>" title="<?php echo $result->title; ?>"></a>
                <div class="card-body">
                  <h4 class="card-title">
                    <a href="#"><?php echo $result->title; ?></a>
                  </h4>
                  <h5><?php echo CURRENCY ?> <?php echo $result->price; ?></h5>
                  <a href="index.php?add=<?php echo $result->id; ?>" class="btn btn-dark mt-2">Add To Cart</a>
                </div>
              </div>
            </div>
        <?php }
        } ?>
      </div>
    </div>



    <div class="container mt-5 my-section">
      <h3 class="py-4">Mens</h3>
      <div class="row">

        <?php

        // FECTH PRODUCTS
        $sql = "SELECT * from products WHERE category='Mens' ORDER BY RAND() LIMIT 4";
        $query = $db->prepare($sql);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);

        if ($query->rowCount() > 0) {
          foreach ($results as $result) {        ?>
            <div class="col-lg-3 col-md-6 mb-4">
              <div class="card h-100">
                <a href="#"><img class="card-img-top" src="./img/products/<?php echo $result->img; ?>" alt="<?php echo $result->title; ?>" title="<?php echo $result->title; ?>"></a>
                <div class="card-body">
                  <h4 class="card-title">
                    <a href="#"><?php echo $result->title; ?></a>
                  </h4>
                  <h5><?php echo CURRENCY ?> <?php echo $result->price; ?></h5>
                  <a href="index.php?add=<?php echo $result->id; ?>" class="btn btn-dark mt-2">Add To Cart</a>
                </div>
              </div>
            </div>
        <?php }
        } ?>
      </div>
    </div>




    <div class="container mt-5 my-section">
      <h3 class="py-4">Womens</h3>
      <div class="row">

        <?php

        // FECTH PRODUCTS
        $sql = "SELECT * from products WHERE category='Women' ORDER BY RAND() LIMIT 4";
        $query = $db->prepare($sql);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);

        if ($query->rowCount() > 0) {
          foreach ($results as $result) {        ?>
            <div class="col-lg-3 col-md-6 mb-4">
              <div class="card h-100">
                <a href="#"><img class="card-img-top" src="./img/products/<?php echo $result->img; ?>" alt="<?php echo $result->title; ?>" title="<?php echo $result->title; ?>"></a>
                <div class="card-body">
                  <h4 class="card-title">
                    <a href="#"><?php echo $result->title; ?></a>
                  </h4>
                  <h5><?php echo CURRENCY ?> <?php echo $result->price; ?></h5>
                  <a href="index.php?add=<?php echo $result->id; ?>" class="btn btn-dark mt-2">Add To Cart</a>
                </div>
              </div>
            </div>
        <?php }
        } ?>

      </div>
    </div>

    <?php include('./inc/footer.php'); ?>
  </section>
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      setTimeout(function() {
        $('#msg').slideUp("slow");
      }, 2000);
    });
  </script>
</body>

</html>