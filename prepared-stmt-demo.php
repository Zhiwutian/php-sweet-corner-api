<?php
require_once('setup.php');
$stmt = $conn->prepare('INSERT INTO `products` (`name`, `description`, `cost`, `image_id`, `updated_at`, `created_at`) VALUES (?, ?, ?, ?, CURRENT_TIME, CURRENT_TIME)');


$name = 'Cupcake 100';
$description = 'Cupcake 100 description';
$cost = 470;
$image_id = 1;

$stmt->bind_param('ssii', $name, $description, $cost, $image_id);

$stmt->execute();

$name = 'Cupcake 101';
$description = 'Cupcake 101 description';
$cose = 821;


$stmt->execute();

print 'New products added';
