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
    $image = $row['image'];
    // UPDATE ? 
    if (isset($_POST['update'])) {
        $name = $_POST['name'];
        $county = $_POST['county'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        if (empty($_FILES['image']['name'])) {
            $image_name = $image;
        }else{
        // Delete OLD Image
        unlink("./upload/$image");
        // Move Image Code
        $image_name = rand(0, 255) . rand(0, 255) .  $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $location = "./upload/$image_name";
        $ifUploaded = move_uploaded_file($tmp_name, $location);
        }

        // Insert Query
        $update = "UPDATE customers SET name = '$name', county= '$county',email = '$email',phone =  '$phone' ,image = '$image_name' where id = $id";
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
            <form method="post" enctype="multipart/form-data">
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

                <div class="form-group">
                    <label for=""> Image Profile <img class="my-2" width="50" src="./upload/<?= $image ?>" alt=""> </label>
                    <input type="file" class="form-control mb-3" accept="image/*" name="image">
                </div>
                <div class="d-grid mx-auto w-50">
                    <button name="update" class="btn btn-warning"> Update </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include_once '../shared/script.php'; ?>