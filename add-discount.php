<?php
session_start();

#If the admin is logged in
if (
    isset($_SESSION['username']) &&
    isset($_SESSION['password'])
) {

    # Category helper function
    include "db_conn.php";
    include "php/func-discount.php";
    $discounts = get_all_discount($conn);
    $bookid = $_GET['id'];
    $discount_current = get_dis_by_book($conn, $bookid);
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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
        <title>Apply Discount BOOKStore</title>
    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-dark" style="padding: 1.5% 7%; width: 100%; border-radius: 0; background-color:#354c7c">
            <div class="container-fluid">
                <a class="navbar-brand" aria-current="page" href="index.php?role=staff" style="margin-right:47%"><span style="color: #fef702;">BOOK</span>Store</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent" style="font-size: 20px;">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="add-book.php">Sách</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="add-category.php">Thể Loại</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="add-program.php">Khuyến Mãi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active " href="admin.php">Quản Trị Viên</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Đăng Xuất</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <form action="php/add-discount.php?bookid=<?= $bookid ?>" method="POST" class="shadow p-4 rounded mt-5" style=" max-width: 40rem; margin:auto;">
                <button type="button" class="btn btn-secondary mb-3">
                    <i class="bi bi-arrow-left"></i>
                    <a href="admin.php" style="text-decoration:none; color:#ffffff;"> Quay Lại</a>
                </button>
                <h1 class="text-center pb-4 display-4 fs-3">
                    Áp dụng Chương Trình Khuyến Mãi
                </h1>
                <?php if (isset($_GET['error'])) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?= htmlspecialchars($_GET['error']); ?>
                    </div>
                <?php } ?>
                <?php if (isset($_GET['success'])) { ?>
                    <div class="alert alert-success" role="alert">
                        <?= htmlspecialchars($_GET['success']); ?>
                    </div>
                <?php } ?>

                <div class="mb-3 row align-items-center">
                    <label class="col-sm-4 col-form-label col-form-label-sm ">Chương Trình</label>
                    <div class="col-sm-8">
                        <select name="discountID" class="form-control" required>
                            <option value="">
                                Chọn
                            </option>
                            <?php
                            if ($discounts == 0) {
                                # Do nothing
                            } else {
                                foreach ($discounts as $discount) {
                                    if ($discount_current == 0) { ?>
                                        <option value="<?= $discount['ID'] ?>">
                                            <?= $discount['D_Name'] ?>
                                        </option>
                                        <?php } else {
                                        if ($discount_current['D_Name'] == $discount['D_Name']) {
                                        ?>
                                            <option selected value="<?= $discount['ID'] ?>">
                                                <?= $discount['D_Name'] ?>
                                            </option>
                                        <?php } else { ?>
                                            <option value="<?= $discount['ID'] ?>">
                                                <?= $discount['D_Name'] ?>
                                            </option>
                            <?php }
                                    }
                                }
                            } ?>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row align-items-center">
                    <label for="exampleInputDOB1" class="col-sm-4 col-form-label col-form-label-sm ">Ngày Bắt Đầu</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" value="" name="startdate" placeholder="yyyy-mm-dd" id="exampleInputSD1" required>
                    </div>
                </div>
                <div class="mb-3 row align-items-center">
                    <label for="exampleInputDOB1" class="col-sm-4 col-form-label col-form-label-sm ">Ngày Kết Thúc</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" value="" name="enddate" placeholder="yyyy-mm-dd" id="exampleInputED1" required>
                    </div>
                </div>
                <div class="mb-3" style="text-align:center;">
                    <button type="submit" class="btn btn-outline-primary">
                        Áp Dụng Ngay</button>
                </div>

            </form>
        </div>
        <footer style="background-color:#354c7c; margin-top:60px;">
            <div class="text-center p-3" style="color:#ffffff;">
                © 2023:
                <a class="navbar-brand" aria-current="page" href="index.php?role=staff"><span style="color: #fef702;">BOOK</span>Store -- bookstore.support@gmail.com</a>
            </div>
            <!-- Copyright -->
        </footer>
    </body>

    </html>

<?php } else {
    header("Location: login.php");
    exit;
} ?>