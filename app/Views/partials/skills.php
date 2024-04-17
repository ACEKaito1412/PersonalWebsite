<?php
$skills = [
    ['name' => 'html', 'img' => 'html.png', 'stars' => 4],
    ['name' => 'css', 'img' => 'css.png', 'stars' => 4],
    ['name' => 'javascript', 'img' => 'javascript.png', 'stars' => 4],
    ['name' => 'mysql', 'img' => 'mysql.png', 'stars' => 4],
    ['name' => 'firebase', 'img' => 'firebase.png', 'stars' => 2],
    ['name' => 'java', 'img' => 'java.png', 'stars' => 3],
    ['name' => 'python', 'img' => 'python.png', 'stars' => 3],
];

?>
<div class="row d-flex flex-column flex-lg-row justify-content-center align-items-center mt-5">
    <h1 class="fw-bolder mb-4 mx-2 p-2 neu-inset text-center ">My Skills</h1>

    <div class="row mt-5 d-flex justify-content-start">
        <?php foreach ($skills as $skill) { ?>
            <div class="col m-1 flex-grow-1 ">
                <div class="card-container d-flex justify-content-center">
                    <div class="p-3 neu-btn ">
                        <a style="text-decoration: none;" href="<?= site_url() . 'projects/' ?>">
                            <div class="front d-flex flex-column align-items-center justify-content-center neu neu-btn" style="width: 160px; height: 160px;">
                                <img src="./public/img/<?= $skill['img'] ?>" alt="" style="width: 100px">
                                <span>
                                    <ul class="list-unstyled d-flex justify-content-center my-color">
                                        <?php for ($i = 0; $i < $skill['stars']; $i++) { ?>
                                            <i class="fa-solid fa-star m-1"></i>
                                        <?php } ?>
                                    </ul>
                                </span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

</div>