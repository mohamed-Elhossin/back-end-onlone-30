<?php
include_once '../shared/config.php';
// Read
$select = "SELECT * FROM customers ";
$data =   mysqli_query($connect, $select);

if (isset($_GET['delete_session'])) {
    session_unset();
    session_destroy();
}
// Detet
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    // Read
    $select_delete = "SELECT * FROM customers  where id =$id";
    $data_delterd =   mysqli_query($connect, $select_delete);
    $row =  mysqli_fetch_assoc($data_delterd);
    $old_image = $row['image'];
    unlink("./upload/$old_image");
    // DELETE 
    $delete = "DELETE FROM customers  where id = $id   ";
    mysqli_query($connect, $delete);
    $_SESSION['message']  = "Delete Customer Successfully";
    // Read
    $select = "SELECT * FROM customers ";
    $data =   mysqli_query($connect, $select);
}


if (isset($_POST['search'])) {
    $search_value = $_POST['search_value'];
    $select = "SELECT * FROM customers where name like '%$search_value%' OR  phone like '%$search_value%' ";
    $data =   mysqli_query($connect, $select);
    $num_rows = mysqli_num_rows($data);
    if ($num_rows == 0) {
        $_SESSION['message'] = "No Search Found $search_value";
    }
}
?>

<?php
include_once '../shared/head.php';
include_once '../shared/nav.php';
?>

<!-- Client Side Search 
 Back-end-search > like
-->
<div class="container col-md-9 my-5">
    <h4 class="text-center my-4"> List All Customer <a class="btn btn-info float-end" href="./create.php">Create New </a> </h4>
    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $_SESSION['message'] ?>
            <a href="?delete_session=done" type="button" class="btn-close"></a>
        </div>
    <?php endif; ?>
    <div class="card">
        <form method="post">
            <div class="row">
                <div class="col-md-9">
                    <div class="form-group">
                        <input type="text" name="search_value" id="myInput" placeholder="Seach By Name OR Phone" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="d-grid">
                        <button name="search" class="btn btn-info"> Search</button>
                    </div>
                </div>
            </div>
        </form>
        <div class="card-body">
            <table id="myTable" class="table table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>

                    <th colspan="3">Action</th>
                </tr>
                <?php foreach ($data as $item): ?>
                    <tr>
                        <th><?= $item['id'] ?></th>
                        <th><?= $item['name'] ?></th>
                        <th><a class="btn btn-info" href="./view.php?view=<?= $item['id'] ?>">view</a> </th>
                        <th><a class="btn btn-warning" href="./update.php?edit=<?= $item['id'] ?>">Edit</a> </th>
                        <th><a class="btn btn-danger" href="?delete=<?= $item['id'] ?>">Delete</a> </th>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>



<?php
if (isset($_SESSION['message'])) {
    echo "<script>
    setTimeout(() => {
        window.location.replace('http://localhost/online/customers/?delete_session=done');
    }, 1000);
</script>
";
}


include_once '../shared/script.php'; ?>