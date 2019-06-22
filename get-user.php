<?php

$output = [
    'success' => false
];

$id = null;

if(isset($_GET['user-id'])){
    $id = $_GET['user-id'];
} else {
    $output['error'] = 'No user ID received';
}

require_once('setup.php');

if(empty($output['error']) && $id){
    $query = "SELECT `id`, `name`, `email`, `created_at`, `updated_at` FROM `users` WHERE `id`=$id";

    $result = $conn->query($query);

    if($result){
        $output['success'] = true;
        $output['user'] = null;

        $num_rows = $result->num_rows;

        if($num_rows === 1){
            $output['user'] = $result->fetch_assoc();
        } elseif($num_rows > 1) {
            $output['message'] = 'Too many users found';
        } else {
            $output['message'] = "No user with ID of $id found";
        }
    } else {
        $output['error'] = 'Database error';
    }
}

print json_encode($output);
