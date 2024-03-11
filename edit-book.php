<?php
session_start();

#If the admin is logged in
if (
    isset($_SESSION['username']) &&
    isset($_SESSION['password'])
) {

    # If book ID is not set
    if (!isset($_GET['id'])) {
        # Redirect to admin.php page
        header("Location: admin.php");
        exit;
    }

    $id = $_GET['id'];

    # Database Connection File
    include "db_conn.php";

    # Book helper function
    include "php/func-book.php";
    $book = get_book($conn, $id);

    # If the ID is invalid
    if ($book == 0) {
        # Redirect to admin.php page
        header("Location: admin.php");
        exit;
    }

    # Category helper function
    include "php/func-category.php";
    $categories = get_all_categories($conn);
    $category_current_Book = get_category_by_BookID($conn, $id);

    # authors helper function
    // include "php/func-author.php";
    // $authors = get_all_author($conn);

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
        <title>Edit Book BOOKStore</title>
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
                            <a class="nav-link active" href="admin.php">Quản Trị Viên</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Đăng Xuất</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">

            <form action="php/edit-book.php" method="POST" enctype="multipart/form-data" class="shadow p-4 rounded mt-5" style=" max-width: 40rem; margin:auto">
                <button type="button" class="btn btn-secondary mb-3">
                    <i class="bi bi-arrow-left"></i>
                    <a href="admin.php" style="text-decoration:none; color:#ffffff;"> Quay Lại</a>
                </button>
                <h1 class="text-center pb-3 display-4 fs-3">
                    Cập Nhật Thông Tin Sách
                </h1>
                <div class="mb-3" style="text-align:right;">

                    <input type="text" hidden value="<?= $book['cover'] ?>" name="current_cover">
                    <a href="uploads/cover/<?= $book['cover'] ?>" class="link-dark">Xem Bìa Sách Hiện Tại</a>
                </div>

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
                <div class="mb-3">
                    <label class="form-label">Mã</label>
                    <input type="text" class="form-control" value="<?= $book['BookID'] ?>" name="book_id">
                </div>

                <div class="mb-3">
                    <label class="form-label">Tên Sách</label>
                    <input type="text" hidden value="<?= $book['BookID'] ?>" name="book_id">

                    <input type="text" class="form-control" value="<?= $book['Title'] ?>" name="book_title">
                </div>

                <div class="mb-3">
                    <label class="form-label">Năm Xuất Bản</label>
                    <input type="text" class="form-control" value="<?= $book['Year_publication'] ?>" name="book_publication">
                </div>

                <div class="mb-3">
                    <label class="form-label">Nhà Xuất Bản</label>
                    <input type="text" class="form-control" value="<?= $book['Publisher'] ?>" name="book_publisher">
                </div>

                <div class="mb-3">
                    <label class="form-label" style="align-self: flex-end;">Mô Tả</label>
                    <input type="text" class="form-control" value="<?= $book['des'] ?>" name="book_description">
                </div>

                <div class="mb-3">
                    <label class="form-label">Tác Giả</label>
                    <input type="text" class="form-control" value="<?= $book['Author'] ?>" name="book_author">
                </div>

                <div class="mb-3">
                    <label class="form-label">Giá(VNĐ)</label>
                    <input type="text" class="form-control" value="<?= $book['List_price'] ?>" name="book_price">
                </div>

                <div class="mb-3">
                    <label class="form-label">Thể Loại</label>
                    <select name="book_category" class="form-control">
                        <option value="">
                            Chọn thể loại
                        </option>
                        <?php
                        if ($categories == 0) {
                            # Do nothing
                        } else {
                            foreach ($categories as $category) {
                                if ($category_current_Book['ID'] == $category['ID']) {
                        ?>
                                    <option selected value="<?= $category['C_Name'] ?>">
                                        <?= $category['C_Name'] ?>
                                    </option>
                                <?php } else { ?>
                                    <option value="<?= $category['C_Name'] ?>">
                                        <?= $category['C_Name'] ?>
                                    </option>
                        <?php }
                            }
                        } ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label" style="align-self: flex-end;">Bìa Sách</label>
                    <input type="file" class="form-control" name="book_cover">
                </div>
                <div class="mb-3" style="text-align:center;">
                    <button type="submit" class="btn btn-outline-primary">
                        Cập Nhật Ngay</button>
                </div>

            </form>
        </div>
        <footer style="background-color:#354c7c; margin-top:50px;">
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