<?php
session_start();

# If the admin is logged in
if (
    !isset($_SESSION['username']) &&
    !isset($_SESSION['password'])
) {

    if (isset($_GET['fullname'])) {
        $fullname = $_GET['fullname'];
    } else $fullname = '';

    if (isset($_GET['DOB'])) {
        $DOB = $_GET['DOB'];
    } else $DOB = '';

    if (isset($_GET['role'])) {
        $role = $_GET['role'];
    } else $role = '';

    if (isset($_GET['un'])) {
        $un = $_GET['un'];
    } else $un = '';
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
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        <title>SIGNUP</title>
    </head>

    <body>
        <div class="d-flex justify-content-center align-items-center" style="min-height: 100vh; background-color:#354c7c">
            <form class="p-5 rounded shadow" style="max-width: 30rem; width: 100%; background-color:#ffffff;" method="POST" action="php/signup.php">
                <button type="button" class="btn btn-secondary mb-3">
                    <i class="bi bi-arrow-left"></i>
                    <a href="index.php" style="text-decoration:none; color:#ffffff;"> <span style="color: #fef702;">BOOK</span>Store</a>
                </button>
                <h1 class="text-center display-4 pb-4">ĐĂNG KÝ</h1>
                <?php if (isset($_GET['error'])) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?= htmlspecialchars($_GET['error']); ?>
                    </div>
                <?php } else if (isset($_GET['success'])) { ?>
                    <div class="alert alert-success" role="alert">
                        <?= htmlspecialchars($_GET['success']); ?>
                    </div>
                <?php } ?>

                <div class="mb-3 row align-items-center">
                    <label for="exampleInputName1" class="col-sm-4 col-form-label col-form-label-sm ">Họ Và Tên</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" value="<?= $fullname ?>" name="fullname" id="exampleInputName1" placeholder="Tên đầy đủ của bạn..." required>
                    </div>

                </div>

                <div class="mb-3 row align-items-center">
                    <label for="exampleInputEmail1" class="col-sm-4 col-form-label col-form-label-sm ">Tên Đăng Nhập</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" value="<?= $un ?>" name="username" id="exampleInputEmail1" placeholder="Tên đăng nhập cho tài khoản..." required>
                    </div>
                </div>

                <div class="mb-3 row align-items-center">
                    <label for="exampleInputPassword1" class="col-sm-4 col-form-label col-form-label-sm ">Mật Khẩu</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Mật khẩu của bạn..." required>
                    </div>
                </div>

                <div class="mb-3 row align-items-center">
                    <label for="exampleInputDOB1" class="col-sm-4 col-form-label col-form-label-sm ">Ngày Sinh</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" value="<?= $DOB ?>" name="DOB" placeholder="yyyy-mm-dd" id="exampleInputDOB1" required>
                    </div>
                </div>

                <div class="mb-3 row align-items-center">
                    <label class="col-sm-4 col-form-label col-form-label-sm ">Role</label>
                    <div class="col-sm-8">
                        <select name="role" class="form-control">
                            <?php if ($role == 'customer') { ?>
                                <option value="">
                                    Select role
                                </option>
                                <option value="customer" selected>
                                    Customer
                                </option>
                            <?php } else { ?>
                                <option value="" selected>
                                    Chọn vai trò
                                </option>
                                <option value="customer">
                                    Khách hàng
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="mb-3" style="text-align:center;">
                    <button type="submit" class="btn btn-outline-primary">
                        Đăng Ký</button>
                </div>
                <div class="mb-3" style="text-align:center;">
                    <p>Nếu bạn đã có tài khoản hãy <a href="login.php">Đăng Nhập</a></p>
                </div>

            </form>
        </div>
    </body>

    </html>
<?php } else {
    header("Location: admin.php");
    exit;
} ?>