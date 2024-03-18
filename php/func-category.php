<?php 
#Get all Categories function
function get_all_categories($con){
    $sql = "SELECT * FROM Categories";
    $stmt = $con->prepare($sql);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $categories = $stmt->fetchAll();
    }else {
        $categories = 0;
    }

    return $categories;
}

#Get category by ID
function get_category($con, $id){
    $sql = "SELECT * FROM Categories WHERE ID=?";
    $stmt = $con->prepare($sql);
    $stmt->execute([$id]);

    if ($stmt->rowCount() > 0) {
        $category = $stmt->fetch();
    }else {
        $category = 0;
    }

    return $category;
}

#Get category by name category
function get_category_by_name($con, $name){
    $sql = "SELECT * FROM Categories WHERE C_Name=?";
    $stmt = $con->prepare($sql);
    $stmt->execute([$name]);

    if ($stmt->rowCount() > 0) {
        $category = $stmt->fetch();
    }else {
        $category = 0;
    }

    return $category;
}

#Get category by BookID
function get_category_by_BookID($con, $id){
    $sql = "SELECT Categories.ID, Categories.C_Name 
            FROM Categories JOIN Belong on Categories.ID = Belong.ID 
            WHERE Belong.BookID=?";
    $stmt = $con->prepare($sql);
    $stmt->execute([$id]);

    if ($stmt->rowCount() > 0) {
        $category = $stmt->fetch();
    }else {
        $category = 0;
    }

    return $category;
}
?>

