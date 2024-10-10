<?php
include_once '../shared/config.php';



if (isset($_GET['edit'])) {
    $update = true;
    $id =  $_GET['edit'];
    // Read One row BY ID
    $select = "SELECT * FROM customers where id  = $id ";
    $data =   mysqli_query($connect, $select);
    //   REC > One Object 
    $row = mysqli_fetch_assoc($data);
    $name = $row['name'];
    $county = $row['county'];
    $email = $row['email'];
    $phone = $row['phone'];
    // UPDATE ? 
    if (isset($_POST['update'])) {
        $name = $_POST['name'];
        $county = $_POST['county'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        // Insert Query
        $update = "UPDATE customers SET name = '$name', county= '$county',email = '$email',phone =  '$phone' where id = $id";
        mysqli_query($connect, $update);
        $_SESSION['message'] = "Update Customer Successfully";
        header("location: /online/customers/");
    }
}


?>

<?php
include_once '../shared/head.php';
include_once '../shared/nav.php';
?>



<div class="container col-md-6">
    <h1 class="text-center text-danger my-4">Update Customer </h1>

    <div class="card">

        <div class="card-body">
            <form method="post">
                <div class="form-group">
                    <label for=""> Customer Name </label>
                    <input type="text" value="<?= $name ?>" class="form-control mb-3" name="name">
                </div>
                <div class="form-group">
                    <label for=""> Customer county </label>
                    <input type="text" value="<?= $county ?>" class="form-control mb-3" name="county">
                </div>
                <div class="form-group">
                    <label for=""> Customer email </label>
                    <input type="email" value="<?= $email ?>" class="form-control mb-3" name="email">
                </div>
                <div class="form-group">
                    <label for=""> Customer phone </label>
                    <input type="tel" value="<?= $phone ?>" class="form-control mb-3" name="phone">
                </div>
                <div class="d-grid mx-auto w-50">

                    <button name="update" class="btn btn-warning"> Update </button>

                </div>
            </form>
        </div>
    </div>
</div>

<?php include_once '../shared/script.php'; ?>