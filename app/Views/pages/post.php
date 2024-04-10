<?php
$data_2 = [
    'page' => $page
];

if ($admin) {
    echo view('/pages/create-post', $data_2);
}

for ($x = 0; $x < count($post); $x++) {
    $item = $post[$x];
    $decoded = json_decode($item['content'], true);
    $data = [
        'item' => $decoded,
        'id' => $item['id']
    ];

    if ($x == 0) {
        echo view('partials/item', $data);
    } else {
        echo view('partials/postList', $data);
    }
}

echo view('/partials/footer-2');
