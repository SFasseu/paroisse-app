<?php
try {
    //Connexion to database
    $bdd = new PDO('mysql:host=localhost;dbname=db_lha','root','');
} catch (\Exception $e) {
    echo 'Error when connected to the database';
}
