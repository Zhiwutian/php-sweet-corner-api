<?php
require_once('setup.php');


$output = [
    'success' => false
];

$name = null;
$email = null;
$password = null;

if(isset($_POST['name'])){
    $name = $_POST['name'];
} else {
    $output['errors'][] ="Missing Name";
}

if(isset($_POST['email'])){
    $email = $_POST['email'];
} else {
    $output['errors'][] ="Missing Email";

}

if(isset($_POST['password'])){
    $password = hash('sha256', $_POST['password']);
} else {
    $output['errors'][] ="Missing Password";

}

if(!empty($output['errors'])) {
    throw new ApiException($output, 422);
}


$query = "INSERT INTO `users` (`name`, `email`, `password`, `created_at`, `updated_at`)
    VALUES ('$name', '$email', '$password', CURRENT_TIME, CURRENT_TIME)";

$result = $conn->query($query);

if($result){
    if($conn->affected_rows){
        $insertedId = $conn->insert_id;

        $output['success'] = true;
        $output['user-id'] = $insertedId;
        $output['message'] = 'User successfully created';
    } else {
        throw new ApiException($output, 406, 'User not created');
    }
} else {
    throw new ApiException($output, 500, 'Database error');

}


print json_encode($output);
