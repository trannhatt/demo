<?php 
session_start();

# Database Connection File
include "db_conn.php";
// $username = $_SESSION['username'];
# Book helper function
include "php/func-book.php";
$books = get_all_books($conn);
// $booksincart = get_book_cart($conn, $username);

# authors helper function
include "php/func-author.php";
$authors = get_all_author($conn);

# Category helper function
include "php/func-category.php";
$categories = get_all_categories($conn);

// if(isset($_GET['role'])){
//     $role = $_GET['role'];
// }
include "php/func-discount.php";


if(isset($_SESSION['role'])){
    $role=$_SESSION['role'];
}else {
    $role='';
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./font/fontawesome-free-6.2.0-web/fontawesome-free-6.2.0-web/css/all.min.css">

    <title>Book Store</title>
</head>
<body>
    <div>
<nav class="navbar navbar-expand-lg navbar-dark" style="padding: 0.7% 7%; position: fixed; z-index: 999; width: 100%; border-radius: 0; background-color: #354c7c;">            <div class="container-fluid">
<a class="navbar-brand"  href="index.php" ><span style="color: #fef702;">BOOK</span>Store</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent" style="font-size: 20px;">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="index.php">Cửa hàng</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="contact.php">Liên hệ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.php">Thông tin</a>
                        </li>
                        <li class="nav-item">
                            <?php if (isset($_SESSION['username'])&&$role=='staff') {?>
                                <a class="nav-link" href="admin.php">Admin</a>
                            <?php }else if (isset($_SESSION['username'])&&$role=='customer'){ ?>
                                <a class="nav-link" href="logout.php">Đăng xuất</a>
                            <?php } else { ?>
                                <a class="nav-link" href="login.php">Đăng nhập</a>
                            <?php } ?>
                        </li>
                        <?php if ($role=='customer') { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="add-cart.php">
                                <i style="font-weight:700;" class="fa-solid fa-cart-shopping"></i>
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner" style="max-height: 500px;">
                <div class="carousel-item active">
                    <img src="img/library3.jpg" class="d-block w-100 ">
                </div>
                <div class="carousel-item">
                    <img src="img/library4.webp" class="d-block w-100 ">
                </div>
                <div class="carousel-item">
                    <img src="img/library5.jpeg" class="d-block w-100 ">
                </div>
            </div>
    <div class="container">
        <!-- About Section -->
        <div class="mt-5 mb-5">
            <h2 class="mb-4">Thông tin liên hệ</h2>
            <p>
		Công ty TNHH Thư Viện Xanh
            </p>
            <p>
		Địa chỉ: Dĩ An, Bình Dương
            </p>
            <p>
		Số điện thoại: 0123xxx456
            </p>
            <p>
		Email: khoa.huynhcs@hcmut.edu.vn
            </p>
        </div>

        <!-- Footer or any additional sections can be added here -->
    </div>

    <!-- Scripts and Bootstrap JS -->
    <!-- ... (same as in the previous file) ... -->
    <footer style="background-color:#354c7c;">
            <div class="text-center p-3" style="color:#ffffff;">
                © 2023:
                <a class="navbar-brand" href="index.php"><span style="color: #fef702;">BOOK</span>Store -- bookstore.support@gmail.com</a>
            </div>
            <!-- Copyright -->
        </footer>
</body>

</html>