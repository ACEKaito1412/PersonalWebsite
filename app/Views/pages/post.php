<?php
$data_2 = [
    'page' => $page
];

if ($admin) {
    echo view('/pages/create-post', $data_2);
}
?>

<div class="col-sm mt-2 mb-3">
    <h1 class="fw-bold mb-4">All Post</h1>
    <?php
    for ($x = 0; $x < count($post); $x++) {
        $item = $post[$x];
        $decoded = json_decode($item['content'], true);
        $data = [
            'item' => $decoded,
            'id' => $item['id']
        ];


        echo view('partials/postList', $data);
    }
    ?>
</div>

<?php
echo view('/partials/footer-2');
?>