<?php
$decoded = json_decode($post['content'], true);
$data = [
    'item' => $decoded,
    'id' => $post['id'],
    'type' => 'post'
];

echo view('/partials/item', $data);
