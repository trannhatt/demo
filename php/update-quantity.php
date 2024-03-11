<?php 
session_start();

#If the admin is logged in
if (isset($_SESSION['username'])&&
    isset($_SESSION['password'])){

    # Database Connection File
    include "../db_conn.php";

    # book helper function
    include "func-book.php";
    
    // check if category name is submitted
    if (isset($_POST['quantity'])) {
        // Get data form POST request
        // and store it in var
        $username = $_SESSION['username'];
        $bookid = $_GET['id'];
        $quantity = $_POST['quantity'];
        if($quantity>0){
            $sql = "CALL UPDATE_TO_CART ('$bookid', '$username', '$quantity')";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $book = get_book($conn, $bookid);
            $sm = 'Cập nhật số lượng sách thành công: ';
            $sm .= $book['Title'];
            header("Location: ../add-cart.php?success=$sm");
            exit;
        } else {
            $sql = "CALL DELETE_TO_CART ('$bookid', '$username')";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $sm = 'Successfully delete';
            header("Location: ../add-cart.php?success=$sm");
            exit;
        }
    }

        // #simple form validation
        // if (empty($name)) {
        //     $em = "The category name is required";
        //     header("Location: ../edit-category.php?error=$em&id=$id");
        //     exit;
        // }else {
        //     $sql = "SELECT Category_exist ('$name') a";
        //     $stmt = $conn->prepare($sql);
        //     $stmt->execute();
        //     $res = $stmt->fetch();

        //     # Update the Database

        //     if($res['a']){
        //         $em = "Category is already exist in database";
        //         header("Location: ../edit-category.php?error=$em&id=$id");
        //         exit;
        //     }else {
        //         $sql = "CALL UPDATE_CATEGORY('$id', '$name')";
        //         $stmt = $conn->prepare($sql);
        //         $stmt->execute();
        //         # Success message
        //         $sm = "Successfully updated!";
        //         header("Location: ../edit-category.php?success=$sm&id=$id");
        //         exit;
        //     }
            /**
             * If there is no error while 
             * updating the data
             */
            // if($res){
            //     # Success message
            //     $sm = "Successfully updated!";
            //     header("Location: ../edit-category.php?success=$sm&id=$id");
            //     exit;
            // }else {
            //     # Error message
            //     $em = "Unknown Error Occured!";
            //     header("Location: ../edit-category.php?error=$em&id=$id");
            //     exit;
            // }
    //     }
    // }else {
    //     header("Location: ../admin.php");
    //     exit;
    // }
}else{
    header("Location: ../login.php");
    exit;
} ?>