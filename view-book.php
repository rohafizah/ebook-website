<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MADAD Ebook Website</title>

    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

    <style>
        #about {
            margin-top: 50px;
        }
    </style>

    <script>
        window.addEventListener("load", () => {
            const loader = document.querySelector(".loader");

            loader.classList.add("loader--hidden");

            loader.addEventListener("transitionend", () => {
                document.body.removeChild(loader);
            });
        });
    </script>
</head>

<body>

   <!-- loader part  -->
<div class="loader">
    <img src="images/book.gif" alt="">
</div>
<!-- loader part  -->

<!-- header section starts      -->
<header>
<?php
session_start();
if(isset($_SESSION['user_id'])) {
  $ebook_link = isset($_SESSION['ebook_link']) ? $_SESSION['ebook_link'] : null;
}
?>
    <a href="index.php" class="logo">ebook.</a>
    <nav class="navbar">
        <a href="index.php">home</a>
        <a href="all-book.php">all books</a>
    </nav>
</header>
<!-- header section ends-->

<!-- about section starts  -->
<section class="about" id="about">
    <div class="row">
        <?php
        include './model/db-connect.php';

        $id = isset($_GET['id']) ? $_GET['id'] : '';

        if (!empty($id)) {
          $id = mysqli_real_escape_string($connect, $id);

          $stmt = mysqli_prepare($connect, "SELECT * FROM ebook WHERE ebook_id = ?");
          mysqli_stmt_bind_param($stmt, "i", $id);
          mysqli_stmt_execute($stmt);

          $result = mysqli_stmt_get_result($stmt);
          $row = mysqli_fetch_assoc($result);

          if ($row) {
            $ebook_nama = strtolower($row['ebook_nama']);
            $ebook_nama = ucwords($ebook_nama);
            $image = $row['ebook_gambar'];
            $link = $row['ebook_link'];
          }
        }
        ?>
        <div class="image">
            <img src="data:image;base64,<?php echo base64_encode($image) ?>" alt="<?= $ebook_nama ?>">
        </div>

        <div class="content">
            <h3><?= $ebook_nama ?></h3>
            <p>Jom baca <?= $ebook_nama ?> sekarang! Dengan ebook ini, anda serta keluarga pastinya akan mendapat suatu ilmu baru yang sangat bermanfaat.</p>

            <?php
            if (isset($_SESSION['user_id'])) {
                // user is signed in, display "Baca Sekarang" button with ebook link
                echo '<a href="' . $row['ebook_link'] . '" class="btn">Baca Sekarang</a>';
            } else {
                // user is not signed in, display "Baca Sekarang" button with sign-in link
                echo '<a href="signin.php?ebook_id=' . $row['ebook_id'] . '" class="btn">Baca Sekarang</a>';
            }
            ?>

        </div>
    </div>
</section>

    <!-- about section ends -->


    <!-- footer section starts  -->

    <section class="footer">
        <div class="credit"> copyright @ 2023 by <span>Murtadha Dakwah Centre (MADAD)</span> </div>
    </section>

    <!-- footer section ends -->


    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <!-- custom js file link  -->
    <script src="js/script.js"></script>

</body>

</html>