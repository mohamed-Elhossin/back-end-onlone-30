<?php
include_once '../shared/config.php';
$count = 1;
// Read
if (isset($_GET['view'])) {
    $id = $_GET['view'];
    $select = "SELECT * FROM `join_all_data` where customer_id = $id ";
    $data =   mysqli_query($connect, $select);
}


?>

<?php
include_once '../shared/head.php';
include_once '../shared/nav.php';
?>

<div class="container col-md-9 my-5">
    <h4 class="text-center my-4"> List All Orders Customers <?= $_GET['view'] ?><a class="btn btn-info float-end" href="./create.php">Create New </a> </h4>
    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $_SESSION['message'] ?>
            <a href="?delete_session=done" type="button" class="btn-close"></a>
        </div>
    <?php endif; ?>
    <div class="card">
        <div class="card-body">
            <table class="table table-dark">
                <tr>
                    <th>ID</th>
                    <th>order_id</th>
                    <th colspan="1">Action</th>
                </tr>
                <?php foreach ($data as $item): ?>
                    <tr>
                        <th> <?= $count++ ?></th>
                        <th> <?= $item['order_id'] ?></th>
                        <th><a class="btn btn-info" href="./view.php?view=<?= $item['order_id'] ?>">view</a> </th>
                    </tr>
                <?php endforeach; ?>

            </table>
        </div>
    </div>
</div>

<?php include_once '../shared/script.php'; ?>