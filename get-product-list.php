<?php

$output = [
    'success' => false
];

require_once('setup.php');

if(empty($output['error'])){
    $query = 'SELECT p.id, p.name, p.cost, i.id AS image_id, i.alt_text, i.file_path
        FROM `products` AS `p`
        JOIN `images` AS `i`
        ON p.image_id=i.id';

    $result =$conn->query($query);

    if($result){
        $output['success'] = true;
        $output['products'] = [];

        if($result->num_rows){
            while($row = $result->fetch_assoc()){
                $product = [
                    'id' => (int) $row['id'],
                    'name' => $row['name'],
                    'cost' => (int) $row['cost'],
                    'image' => [
                        'id' => (int) $row['image_id'],
                        'alt' => $row['alt_text'],
                        'src' => $row['file_path']
                    ]
                ];

                $output['products'][] = $product;
            }
        }
    }
}

print json_encode($output);
