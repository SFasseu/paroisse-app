<?php
//call connexion to the database
require_once('config/db.php');

//query table contact
$query = $bdd->query('select * from contact');

//get all data
$contacts = $query->fetchAll();

//traitment of data
/*
foreach ($contacts as $key => $contact) {
    $id = $contact['id'];
    $name = $contact['nom'];
    $email = $contact['email'];
    $address = $contact['adresse'];
}
*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>List of contact</title>
</head>
<body>
    <div class="container mt-5">
        <div class="row mb-3">
            <div class="col-2">
                <a href="create.php" class="btn btn-success btn-sm">Nouveau contact</a>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col">
                <table class="table table-responsive table-hover table-striped">
                    <thead class="bg-primary text-light">
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        <?php foreach ($contacts as $key => $contact) {  ?>
                        <tr>
                            <td><?= ++$key ?></td>
                            <td><?= $contact['nom'] ?></td>
                            <td><?= $contact['email'] ?></td>
                            <td><?= $contact['adresse'] ?></td>
                            <td>
                                <a href="" class="btn btn-warning btn-sm">Edit</a>
                                <a href="" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
