<?php
include_once '../shared/config.php';
$count = 1;
// Read

if (isset($_GET['view'])) {
    $id = $_GET['view'];
    $select = "SELECT * FROM `join_all_data` where order_id = $id ";
    $data =   mysqli_query($connect, $select);
    $row = mysqli_fetch_assoc($data);
}



?>

<?php
include_once '../shared/head.php';
include_once '../shared/nav.php';
?>

<div class="container col-md-9 my-5">
    <h4 class="text-center my-4"> List Orders <?= $row['order_id'] ?> <a class="btn btn-info float-end" href="./index.php">Back </a> </h4>
    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $_SESSION['message'] ?>
            <a href="?delete_session=done" type="button" class="btn-close"></a>
        </div>
    <?php endif; ?>
    <div class="card">
        <div class="card-body">
            <h6> Order ID <?= $row['order_id'] ?> </h6>
            <hr>
            <h6> amount <?= $row['amount'] ?> </h6>
            <hr>
            <h6> date <?= $row['date'] ?> </h6>
            <hr>
            <h5 class="text-center"> Customer </h5>
            <h6> customer_id <?= $row['customer_id'] ?> </h6>
            <hr>
            <h6> customer_name <?= $row['customer_name'] ?> </h6>
            <hr>
            <h6> county <?= $row['county'] ?> </h6>
            <hr>
            <h6> email <?= $row['email'] ?> </h6>
            <hr>
            <h6> phone <?= $row['phone'] ?> </h6>
            <hr>
            <h5 class="text-center"> Product </h5>
            <h6> prod_id <?= $row['prod_id'] ?> </h6>
            <hr>
            <h6> prod_name <?= $row['prod_name'] ?> </h6>
            <hr>
            <h6> price <?= $row['price'] ?> </h6>
            <hr>
        </div>
    </div>
</div>

<?php include_once '../shared/script.php'; ?>