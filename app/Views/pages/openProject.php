<?php
$decoded = json_decode($project['content']);
$data = [
    'id' => $project['id'],
    'item' => $decoded,
    'project' => $project
];


if ($project['content'] == '') {
    if ($admin) {
?>
        <div class="alert alert-danger alert-dismissible fade show mt-2 neu" role="alert" style="border: none ;">
            <strong>Project just created!</strong> Modify the content for the viewers.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <div class="card d-flex justify-content-center p-4 neu-inset text-right" id="content">
        </div>
    <?php } else {
        echo view('partials/coming-soon');
    } ?>



    <?php if ($admin) {
        echo view('/partials/createButtons', $data);
    ?>
        <div class="d-flex flex-row justify-content-end mt-2 mb-3">
            <button class="btn neu neu-btn" onclick="saveContent(<?= $project['id'] ?>, 'update', 'project')">Save Changes</button>
        </div>
<?php }
} else {
    $decoded = json_decode($project['content'], true);
    $data = [
        'id' => $project['id'],
        'item' => $decoded,
        'type' => 'project'
    ];
    echo view('partials/item', $data);
}

echo view('/partials/footer-2');
?>