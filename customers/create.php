<?php
include_once '../shared/config.php';



if (isset($_POST['send'])) {
    $name = $_POST['name'];
    $county = $_POST['county'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Move Image Code
    $image_name = rand(0, 255) . rand(0, 255) .  $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $location = "./upload/$image_name";
    $ifUploaded = move_uploaded_file($tmp_name, $location);

    // Insert Query Image
    $insertCustomer = "INSERT INTO customers VALUES (null , '$name','$county','$email','$phone','$image_name')";
    mysqli_query($connect, $insertCustomer);
    $_SESSION['message'] = "Create Customer Successfully";
    header("location: /online/customers/");
}

// print_r(($_FILES));

?>

<?php
include_once '../shared/head.php';
include_once '../shared/nav.php';
?>



<div class="container col-md-6">
    <h1 class="text-center my-4">Create New Customer </h1>

    <div class="card">

        <div class="card-body">
            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for=""> Customer Name </label>
                    <input type="text" class="form-control mb-3" name="name">
                </div>
                <div class="form-group">
                    <label for=""> Customer county </label>
                    <input type="text" class="form-control mb-3" name="county">
                </div>
                <div class="form-group">
                    <label for=""> Customer email </label>
                    <input type="email" class="form-control mb-3" name="email">
                </div>
                <div class="form-group">
                    <label for=""> Customer phone </label>
                    <input type="tel" class="form-control mb-3" name="phone">
                </div>
                <div class="form-group">
                    <label for=""> Image Profile </label>
                    <input type="file" class="form-control mb-3" accept="image/*" name="image">
                </div>
                <div class="d-grid mx-auto w-50">
                    <button name="send" class="btn btn-info"> Submit </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include_once '../shared/script.php'; ?>