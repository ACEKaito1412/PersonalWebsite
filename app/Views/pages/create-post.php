<div class="row d-flex flex-column flex-lg-row justify-content-center mt-5">
    <h1 style="color: gray;">Create Post</h1>
    <div class="col-sm">
        <div class="card d-flex justify-content-center p-4 neu-inset text-right" id="content">

        </div>
    </div>

    <?php
    $data = [
        'page' => $page
    ];
    echo view('partials/createButtons', $data);
    ?>

    <div id="status"></div>
</div>
<hr>