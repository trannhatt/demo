<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (
    isset($_SESSION['username']) &&
    isset($_SESSION['password'])
) {
    $username = $_SESSION['username'];

    # Database Connection File
    include "db_conn.php";

    # authors helper function
    include "php/func-author.php";
    $authors = get_all_author($conn);

    # Category helper function
    include "php/func-category.php";
    $categories = get_all_categories($conn);

    # Payment helper function
    include "php/func-payment.php";
    $total = total_bill($conn, $username);

    include "php/func-discount.php";

    if (isset($_SESSION['role'])) {
        $role = $_SESSION['role'];
    } else {
        $role = '';
    }

    if (isset($_GET['add'])) {
        if (isset($_POST['bookid'])) {
            $bookid = $_POST['bookid'];
        }

        $sql = "SELECT EXIST_BOOK('$bookid', '$username') a";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetch();
        $res = $res['a'];
        if ($res) {
            $res = $res + 1;
            $sql = "CALL UPDATE_TO_CART('$bookid', '$username', '$res')";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
        } else {
            $sql = "CALL ADD_TO_CART('$bookid', '$username')";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
        }
        header("Location: add-cart.php");
    }
    # Book helper function
    include "php/func-book.php";
    $books = get_book_cart($conn, $username);

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css">
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="./font/fontawesome-free-6.2.0-web/fontawesome-free-6.2.0-web/css/all.min.css">

        <title>Add to cart</title>
    </head>

    <body>
        <div>
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

                            <li class="nav-item">
                                <a class="nav-link active" href="add-cart.php">
                                    <i style="font-weight:700; margin-left: 10%;" class="fa-solid fa-cart-shopping"></i>
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>
            </nav>
        </div>

        <div class="container" style="margin-bottom:150px;">
            <?php if ($books) { ?>
                <div class="row px-md-4 px-2 pt-4">
                    <div class="col-lg-8" style="margin-top:60px;">
                        <h4 class="pb-2 ">Đơn hàng của bạn</h4>
                        <div class="card" style="width: 100%;">
                            <!-- <div class="ribbon ribbon-top-right"><span>SALE TIME!</span></div> -->
                            <div>
                                <div class="table-responsive px-md-4 px-2 pt-3">
                                    <table class="table table-borderless">
                                        <tbody>
                                            <?php foreach ($books as $book) {
                                                $discount = get_dis_by_book($conn, $book['BookID']);
                                            ?>
                                                <tr class="border-bottom">
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div> <img class="pic" src="uploads/cover/<?= $book['cover'] ?>" alt=""> </div>
                                                            <div class="ps-3 d-flex flex-column justify-content">
                                                                <p class="fw-bold"><span class="ps-1"><?= $book['Title'] ?></span></p> <small class=" d-flex"> <span class=" text-muted">Tác giả: </span> <span class=" fw-bold"><?= $book['Author'] ?></span> </small> <small class=""> <span class=" text-muted">Thể loại:</span> <span class=" fw-bold"><?= get_category_by_BookID($conn, $book['BookID'])['C_Name'] ?></span> </small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <?php if ($discount) { ?>
                                                                <p class="text-muted text-decoration-line-through"><?= number_format($book['List_price'] * is_book_contain($conn, $book['BookID'], $username), 0, ',', '.') ?></p><i class="pe-3">-<?= $discount['Percents'] * 100 ?>%</i>
                                                                <p class="pe-3"><span class="red"><?= number_format($book['List_price'] * (1 - $discount['Percents']) * is_book_contain($conn, $book['BookID'], $username), 0, ',', '.') ?></span></p>
                                                            <?php } else { ?>
                                                                <p class="pe-3"><span class="text-muted"><?= number_format($book['List_price'] * is_book_contain($conn, $book['BookID'], $username), 0, ',', '.') ?>VNĐ</span></p>
                                                            <?php } ?>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <form action="php/update-quantity.php?id=<?= $book['BookID'] ?>" method="POST">
                                                            <div class="d-flex align-items-center"> <span class="pe-3 text-muted">Số lượng</span> <span class="pe-3"> <input name="quantity" class="ps-2" type="number" placeholder="" value="<?= is_book_contain($conn, $book['BookID'], $username) ?>" min="0"></span>
                                                                <button type="submit" class="btn btn-info">Cập nhật</button>
                                                            </div>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <?php if (isset($_GET['success'])) {
                            $sm = $_GET['success'];
                        ?>
                            <div class="alert alert-success" role="alert">
                                <?= htmlspecialchars($_GET['success']); ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="col-lg-4 payment-summary" style="margin-top:60px;">
                        <h4 class="pt-lg-0 pt-4 pb-2">Tổng giá</h4>
                        <div class="card px-md-3 px-2 pt-4">
                            <div class="unregistered mb-4"> <span class="py-1"><?= $username ?></span> </div>
                            <div class="d-flex justify-content-between pb-3"> <small class="text-muted">Mã giao dịch</small>
                                <p class="">VC115665</p>
                            </div>
                            <div class="d-flex justify-content-between b-bottom"> <input type="text" class="ps-2" placeholder="Mã giảm giá">
                                <div class="btn btn-primary">Nhập</div>
                            </div>
                            <div class="d-flex flex-column b-bottom">
                                <div class="d-flex justify-content-between py-3"> <small class="text-muted">Tổng đơn hàng</small>
                                    <p><?= number_format($total, 0, ',', '.') ?>VNĐ</p>
                                </div>
                                <div class="d-flex justify-content-between pb-3"> <small class="text-muted">Thuế VAT (10%)</small>
                                    <p><?= number_format($total * 0.1, 0, ',', '.') ?>VNĐ</p>
                                </div>
                                <div class="d-flex justify-content-between"> <small class="text-muted">Tổng cộng</small>
                                    <p><?= number_format($total * 1.1, 0, ',', '.') ?>VNĐ</p>
                                </div>
                            </div>
                            <div class="sale my-3"> <span>Đơn hàng<span class="px-1">hết hạn</span><span>trong</span>:</span><span class="red">21<span class="ps-1">giờ</span>,31<span class="ps-1 ">phút</span></span> </div>
                            <form action="php/payment.php" method="POST">
                                <input type="text" hidden name="payment" value="<?= $username ?>">
                                <button type="submit" class="btn btn-primary mb-2 w-100">Thanh toán</button>
                            </form>

                        </div>

                    </div>
                </div>
            <?php } else { ?>
                <?php if (isset($_GET['error'])) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?= htmlspecialchars($_GET['error']); ?>
                    </div>
                <?php } ?>
                <?php if (isset($_GET['success'])) {
                    $sm = $_GET['success'];
                    if ($sm == 'Successfully pay') { ?>
                        <div class="alert alert-success" role="alert">
                            <?= htmlspecialchars($_GET['success']); ?>
                        </div>
                <?php }
                } ?>
                <div style="text-align:center">
                    <a href="index.php"><img class="w-50" src="img/no item in cart.jpg" alt="no image"></a>
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
<?php } else {
    header("Location: login.php");
    exit;
} ?>