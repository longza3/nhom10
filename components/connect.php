<?php
    // $conn = mysqli_connect('localhost', 'root', '','shop_db');
    // mysqli_query($conn, 'set names "utf8"');


$db_name = 'mysql:host=localhost;dbname=shop_db';
$user_name = 'root';
$user_password = '';

$conn = new PDO($db_name, $user_name, $user_password);


function create_unique_id(){
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $characters_lenght = strlen($characters);
    $random_string = '';
    for($i = 0; $i < 20; $i++){
       $random_string .= $characters[mt_rand(0, $characters_lenght - 1)];
    }
    return $random_string;
 }
?>