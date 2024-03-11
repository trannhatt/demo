<?php
session_start();


# If not author is set
if (!isset($_GET['author'])) {
    header("Location: index.php");
    exit;
}

# check role for user
if (isset($_SESSION['role'])) {
    $role = $_SESSION['role'];
} else {
    $role = '';
}

# Get category ID from GET request
$author_name = $_GET['author'];

# Database Connection File
include "db_conn.php";

# Book helper function
include "php/func-book.php";
$books = get_book_by_author($conn, $author_name);

# authors helper function
include "php/func-author.php";
$authors = get_all_author($conn);

# Category helper function
include "php/func-category.php";
$categories = get_all_categories($conn);
// $current_category = get_category($conn, $id)

include "php/func-discount.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./font/fontawesome-free-6.2.0-web/fontawesome-free-6.2.0-web/css/all.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <title><?= $author_name ?></title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark" style="padding: 0.7% 7%; position: fixed; z-index: 999; width: 100%; border-radius: 0; background-color: #354c7c;">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><span style="color: #fef702;">BOOK</span>Store</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent" style="font-size: 20px;">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Cửa hàng</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Liên hệ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">Thông tin</a>
                    </li>
                    <li class="nav-item">
                        <?php if (isset($_SESSION['username']) && $role == 'staff') { ?>
                            <a class="nav-link" href="admin.php">Admin</a>
                        <?php } else if (isset($_SESSION['username']) && $role == 'customer') { ?>
                            <a class="nav-link" href="logout.php">Đăng xuất</a>
                        <?php } else { ?>
                            <a class="nav-link" href="login.php">Đăng nhập</a>
                        <?php } ?>
                    </li>
                    <?php if ($role == 'customer') { ?>
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
        <!-- <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button> -->
    </div>
    <br>
    <div class="container">
        <div class="row">
            <!-- List of categories -->
            <div class="col-md-6" style="max-height: 400px; overflow-y: auto; margin-bottom:40px;">
                <div class="list-group">
                    <?php if ($categories == 0) {
                        // Không có thể loại
                    } else { ?>
                        <div class="list-group-item" style="background-color:#354c7c; color:#ffffff;">Thể loại</div>
                        <div class="scrollable-list" style="max-height: 350px; overflow-y: auto;">
                            <?php foreach ($categories as $category) { ?>
                                <a href="category.php?id=<?= $category['ID'] ?>" class="list-group-item list-group-item-action"><?= $category['C_Name'] ?></a>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            </div>



            <!-- List of authors -->
            <div class="col-md-6" style="max-height: 400px; overflow-y: auto;margin-bottom:40px;">
                <div class="list-group">
                    <?php if ($authors == 0) {
                        // Không có tác giả
                    } else { ?>
                        <div class="list-group-item" style="background-color:#354c7c; color:#ffffff;">Tác giả</div>
                        <div class="scrollable-list" style="max-height: 350px; overflow-y: auto;">
                            <?php foreach ($authors as $author) { ?>
                                <a href="author.php?author=<?= $author['Author'] ?>" class="list-group-item list-group-item-action"><?= $author['Author'] ?></a>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            </div>


        </div>
        <h1 class="display-4 p-3 fs-3">
            <a href="index.php" class="nd">
                <img src="img/back.png" width="35">
            </a>
            Sách của: <?= $author_name ?>
        </h1>
        <div class="d-flex pt-3">
            <?php if ($books == 0) { ?>
                <div class="alert alert-warning p-5 text-center" role="alert" style="width:100%">
                    <img src="img/nothing-icon.jpg" width="100">
                    <br>
                    <b>"<?= $key ?>"</b> Không tìm thấy sách
                </div>

            <?php } else { ?>
                <div class="justify-content-center pdf-list d-flex flex-wrap" style="width:110%;">
                    <?php foreach ($books as $book) { ?>
                        <form action="add-cart.php?add=<?= $book['BookID'] ?>" method="POST" style="padding:10px 10px;">
                            <div class="card m-1" style="height: auto;">
                                <div style="height: 600px; overflow-y: auto;">
                                    <img src="uploads/cover/<?= $book['cover'] ?>" class="card-img-top" width="auto">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $book['Title'] ?></h5>
                                        <p style="font-size: 20px;">
                                            <b> <?= number_format($book['List_price'], 0, ',', '.') ?> VNĐ</b>
                                        </p>
                                        <p class="card-text">
                                            <i><b>Tác giả: <?= $book['Author'] ?><br></b></i>
                                            <?= $book['des'] ?><br>
                                            <i><b>Thể loại: <?= get_category_by_BookID($conn, $book['BookID'])['C_Name'] ?><br></b></i>
                                        </p>
                                        <?php if (get_dis_by_book($conn, $book['BookID'])) { ?>
                                            <p style="font-size: 20px;">
                                                <b style="color: red;">Sale off <?= get_dis_by_book($conn, $book['BookID'])['Percents'] * 100 ?>%</b>
                                            </p>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div style=" bottom: 0; padding:10px 30px;">
                                    <a href="uploads/cover/<?= $book['cover'] ?>" class="btn btn-primary" style="width: 49%;">Mở</a>

                                    <a href="uploads/cover/<?= $book['cover'] ?>" class="btn btn-outline-primary" style="width: 49%;" download=<?= $book['Title'] ?>>Tải về</a>
                                    <br>
                                    <?php if ($role == 'staff') { ?>
                                        <!-- Do nothing -->
                                    <?php } else { ?>
                                        <input type="text" name="bookid" value="<?= $book['BookID'] ?>" hidden>
                                        <button type="submit" class="btn btn-success mt-1 w-100">Thêm vào giỏ</button>
                                    <?php } ?>
                                </div>
                            </div>

                        </form>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
        <footer style="background-color:#354c7c;">
            <div class="text-center p-3" style="color:#ffffff;">
                © 2023:
                <a class="navbar-brand" href="index.php"><span style="color: #fef702;">BOOK</span>Store -- bookstore.support@gmail.com</a>
            </div>
            <!-- Copyright -->
        </footer>
</body>

</html>