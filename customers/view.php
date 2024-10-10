<?php
include_once '../shared/config.php';
// Read


if (isset($_GET['view'])) {
    $id = $_GET['view'];

    $select = "SELECT * FROM customers where id = $id   ";
    $data =   mysqli_query($connect, $select);
    $row = mysqli_fetch_assoc($data);
} else {
    header("location: index.php");
}



?>

<?php
include_once '../shared/head.php';
include_once '../shared/nav.php';
?>

<div class="container col-md-4 my-5">
    <h4 class="  my-4"> List Customer <?= $row['id'] ?> <a class="btn btn-info float-end" href="./index.php">Back </a> </h4>
    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $_SESSION['message'] ?>
            <a href="?delete_session=done" type="button" class="btn-close"></a>
        </div>
    <?php endif; ?>
    <div class="mx-auto card">
        <img width="40%" class="mx-auto" src="./upload/<?= $row['image'] ?>" alt="">
        <div class="card-body">
            <h6>name : <?= $row['name'] ?></h6>
            <hr>
            <h6>county : <?= $row['county'] ?></h6>
            <hr>
            <h6>email : <?= $row['email'] ?></h6>
            <hr>
            <h6>phone : <?= $row['phone'] ?></h6>
            <hr>
            <div class="d-grid">
                <a href="/online/orders/one_cusotmer.php?view=<?= $row['id'] ?>" class="btn btn-info"> Customer's Orders</a>
            </div>

        </div>
    </div>
</div>

<?php include_once '../shared/script.php'; ?>