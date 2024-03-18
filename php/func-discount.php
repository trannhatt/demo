<?php
#Get All discount function
function get_all_discount($con){
    $sql = "SELECT * FROM Dis_program";
    $stmt = $con->prepare($sql);
    $stmt->execute();

    if($stmt->rowCount() > 0) {
        $discounts = $stmt->fetchAll();
    }else {
        $discounts = 0;
    }

    return $discounts;
}

function get_dis_by_book($con, $bookid){
    $sql = "SELECT * FROM Dis_program LEFT JOIN Applies ON Dis_program.ID = Applies.ID WHERE Applies.BookID = $bookid";
    $stmt = $con->prepare($sql);
    $stmt->execute();

    if($stmt->rowCount() > 0) {
        $discount = $stmt->fetch();
    }else {
        $discount = 0;
    }

    return $discount;
}
?>