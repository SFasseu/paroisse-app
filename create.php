<?php
//call connexion to the database
require_once('config/db.php');

if (isset($_POST) and count($_POST) > 0) {
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $address = $_POST["address"];


    $req = $bdd->prepare('INSERT INTO contact (nom, telephone, email, adresse) VALUES(:name, :phone, :email, :address)');

    $req->execute(array(
        'name' => $name,
        'phone' => $phone,
        'email' => $email,
        'address' => $address
    ));
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>New contact</title>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <h1>Add new Contact</h1>
            <div class="col">
                <form action="create.php" method="post">
                    <div class="row">
                        <div class="col-4">
                            <label class="form-label" for="name">Name</label>
                            <input required class="form-control" type="text" name="name" id="name">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <label class="form-label" for="phone">Phone</label>
                            <input required class="form-control" type="text" name="phone" id="phone">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <label class="form-label" for="email">Email</label>
                            <input class="form-control" type="email" name="email" id="email">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <label class="form-label" for="address">Address</label>
                            <input class="form-control" type="text" name="address" id="address">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-4 d-flex justify-content-end">
                            <input class="btn btn-success" type="submit" value="Save">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>