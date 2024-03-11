<?php
session_start();

#If the admin is logged in
if (
    isset($_SESSION['username']) &&
    isset($_SESSION['password'])
) {

    # Database Connection File
    include "db_conn.php";

    # Book helper function
    include "php/func-book.php";
    $books = get_all_books($conn);

    // # authors helper function
    // include "php/func-author.php";
    // $authors = get_all_author($conn);

    # Category helper function
    include "php/func-category.php";
    $categories = get_all_categories($conn);

    include "php/func-discount.php";
    $discounts = get_all_discount($conn);

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
        <title>Admin BOOKStore</title>
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

        <!-- style="background-color: " -->
        <div class="container">

            <form action="search.php" method="GET" style="text-align: -webkit-center;">
                <h4 class="mt-5">Quản Lý Sách Và Thể Loại</h4>
                <div class="input-group my-5" style="width: 50%;">
                    <input type="text" class="form-control" name="key" placeholder="Tìm kiếm sách..." aria-label="Search Book..." aria-describedby="basic-addon2">

                    <button class="input-group-text btn btn-outline-secondary" id="basic-addon2">
                        <img src="img/search.png" width="20">
                    </button>
                </div>
            </form>
            <?php if (isset($_GET['success'])) { ?>
                <div class="alert alert-success" role="alert">
                    <?= htmlspecialchars($_GET['success']); ?>
                </div>
            <?php } ?>

            <?php if ($books == 0) { ?>
                <div class="alert alert-warning p-5 text-center" role="alert">
                    <img src="img/nothing-icon.jpg" width="100">
                    <br>
                    Không tìm thấy sách được chọn trong Cơ Sở dữ Liệu
                </div>
            <?php } else { ?>

                <!-- List of all books -->
                <h5 class="mt-5">Danh Mục Sách</h5>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" style="border-color:#ebecf0;">
                        <thead style="background-color:#354c7c; color:#ffffff; text-align:center">
                            <tr>
                                <th>STT</th>
                                <th>Mã</th>
                                <th>Bìa Sách</th>
                                <th>Tên Sách</th>
                                <th>Tác Giả</th>
                                <th>Nhà Xuất Bản</th>
                                <th>Miêu Tả</th>
                                <th>Thể Loại</th>
                                <th>Giá Tiền(VNĐ)</th>
                                <th>Ưu Đãi</th>
                                <th>Chức Năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            foreach ($books as $book) {
                                $i++;
                            ?>
                                <tr>
                                    <td style=" min-width: 50px; text-align:center;"><?= $i ?></td>
                                    <td style=" min-width: 50px; text-align:center;"><?= $book['BookID'] ?></td>
                                    <td>
                                        <img width="100" src="uploads/cover/<?= $book['cover'] ?>" alt="no image">
                                    </td>
                                    <td style="max-width: 150px">
                                        <p><b><?= $book['Title'] ?></b></p>
                                    </td>
                                    <td>
                                        <i> <?= $book['Author'] ?></i>
                                    </td>
                                    <td>
                                        <?= $book['Publisher'] ?>-<?= $book['Year_publication'] ?>
                                    </td>
                                    <td style="max-width: 800px; text-align:justify"><?= $book['des'] ?></td>
                                    <td style="min-width: 100px;">
                                        <?php
                                        if ($categories == 0) {
                                            echo "Undefined";
                                        } else {
                                            $BookID = $book['BookID'];
                                            $sql = "SELECT C_Name, BookID 
                                                FROM BELONG 
                                                INNER JOIN categories 
                                                ON BELONG.ID = categories.ID
                                                WHERE BELONG.BOOKID = $BookID";
                                            $stmt = $conn->prepare($sql);
                                            $stmt->execute();
                                            $result = $stmt->fetch();
                                            echo ($result['C_Name']);
                                        }
                                        ?>
                                    </td>
                                    <td style="min-width: 130px;text-align:center;">
                                        <?= number_format($book['List_price'], 0, ',', '.') ?>
                                    </td>
                                    <td style="min-width: 100px;text-align:center;">
                                        <?php
                                        if ($discounts == 0) { ?>
                                            <!-- DO notthing -->
                                            <?php } else {
                                            $BookID = $book['BookID'];
                                            $sql = "SELECT D_Name
                                                FROM dis_program 
                                                JOIN applies
                                                ON dis_program.ID = applies.ID
                                                WHERE applies.BOOKID = $BookID";
                                            $stmt = $conn->prepare($sql);
                                            $stmt->execute();
                                            $results = $stmt->fetchAll();
                                            foreach ($results as $result) { ?>
                                                <?= $result['D_Name'] ?> <br>
                                            <?php } ?>
                                        <?php } ?>
                                    </td>
                                    <td style="min-width: 90px; text-align:center;">

                                        <a href="edit-book.php?id=<?= $book['BookID'] ?>" class="btn btn-outline-primary">
                                            <i class=" bi bi-pen"></i></a>
                                        <a href="php/delete-book.php?id=<?= $book['BookID'] ?>" class="btn btn-outline-danger">
                                            <i class="bi bi-trash"></i></a>
                                        <a href="add-discount.php?id=<?= $book['BookID'] ?>" class="btn btn-outline-primary" style="margin-top:7%;">
                                            <i class="bi bi-plus"></i>Ưu Đãi</a>


                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            <?php } ?>

            <?php if ($categories == 0) { ?>
                empty
            <?php } else { ?>

                <!-- List of all books -->
                <h4 class="mt-5">Thể Loại</h4>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" style="border-color:#ebecf0;">
                        <thead style="background-color:#354c7c; color:#ffffff; text-align:center">
                            <tr>
                                <th>Mã</th>
                                <th>Tên Thể Loại</th>
                                <th>Số Lượng Sách</th>
                                <th>Chức Năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            foreach ($categories as $category) {
                                $i++;
                            ?>
                                <tr>
                                    <td style=" min-width: 50px; text-align:center;"><?= $i ?></td>
                                    <td>
                                        <?= $category['C_Name'] ?>
                                    </td>
                                    <td style=" min-width: 50px; text-align:center;">
                                        <?php
                                        $category_ID = $category['ID'];
                                        $sql = "SELECT TOTAL_BOOK('$category_ID') a";
                                        $stmt = $conn->prepare($sql);
                                        $stmt->execute();
                                        $result = $stmt->fetch();
                                        echo ($result['a']);
                                        ?>
                                    </td>
                                    <td style="min-width: 70px; text-align:center;">
                                        <a href="edit-category.php?id=<?= $category['ID'] ?>" class="btn btn-outline-primary">
                                            <i class=" bi bi-pen"></i></a>
                                        <a href="#" class="btn btn-outline-danger">
                                            <i class="bi bi-trash"></i></a>
                                    </td>

                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            <?php } ?>
        </div>
        <footer style="background-color:#354c7c;">
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