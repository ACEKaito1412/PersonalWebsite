<div class="col-sm mt-2 mb-3">
    <h1 class="fw-bold my-color">Projects</h1>
    <?php
    if ($admin) {
        echo view('/partials/createProjects');
    }

    foreach ($projects as $project) {
        $data = [
            'project' => $project
        ];

        echo view('/partials/projectsMain', $data);
    }

    echo view('partials/footer-2');
    ?>
</div>