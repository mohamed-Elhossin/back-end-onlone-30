<?php
include_once '../shared/config.php';


// Select Customers
$select_customers = "SELECT * FROM customers ";
$customers_data =   mysqli_query($connect, $select_customers);
// Select Products
$select_products = "SELECT * FROM `products` ";
$products_data =   mysqli_query($connect, $select_products);


if (isset($_POST['send'])) {
    $amount = $_POST['amount'];
    $cutomer_id = $_POST['cutomer_id'];
    $product_id = $_POST['product_id'];

    $current_Data = date('Y-m-d H:i:s');
    // Insert Query
    $insertCustomer = "INSERT INTO orders VALUES (null , $amount ,$cutomer_id,$product_id,'$current_Data')";
    mysqli_query($connect, $insertCustomer);
    $_SESSION['message'] = "Create Order Successfully";
    header("location: /online/orders/");
}

?>

<?php
include_once '../shared/head.php';
include_once '../shared/nav.php';
?>



<div class="container col-md-6">
    <h1 class="text-center my-4">Create New Order </h1>

    <div class="card">

        <div class="card-body">
            <form method="post">
                <div class="form-group">
                    <label for=""> Order Amount </label>
                    <input type="number" class="form-control mb-3" name="amount">
                </div>
                <div class="form-group">
                    <label for=""> Customer_ID </label>
                    <select name="cutomer_id" id="" class="form-control">
                        <option disabled selected> -- select customer --</option>
                        <?php foreach ($customers_data as $item):  ?>
                            <option value="<?= $item['id'] ?>"> <?= $item['name'] ?> </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for=""> Product_ID </label>
                    <select name="product_id" id="" class="form-control">
                        <option disabled selected> -- select product --</option>
                        <?php foreach ($products_data as $item):  ?>
                            <option value="<?= $item['id'] ?>"> <?= $item['name'] ?> </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="d-grid mx-auto w-50">

                    <button name="send" class="btn btn-info"> Submit </button>

                </div>
            </form>
        </div>
    </div>
</div>

<?php include_once '../shared/script.php'; ?>