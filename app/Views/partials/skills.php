<?php
$skills = [
    ['name' => 'html', 'img' => 'html.png', 'stars' => 4],
    ['name' => 'css', 'img' => 'css.png', 'stars' => 4],
    ['name' => 'javascript', 'img' => 'javascript.png', 'stars' => 4],
    ['name' => 'mysql', 'img' => 'mysql.png', 'stars' => 4],
    ['name' => 'firebase', 'img' => 'firebase.png', 'stars' => 4],
    ['name' => 'java', 'img' => 'java.png', 'stars' => 4],
    ['name' => 'python', 'img' => 'python.png', 'stars' => 4],
];

?>
<div class="row d-flex flex-column flex-lg-row justify-content-center align-items-center mt-5">
    <h1 class="fw-bolder mb-4 p-2 neu-inset text-center ">My Skills</h1>

    <div class="row mt-5 d-flex justify-content-start">
        <?php foreach ($skills as $skill) { ?>
            <div class="col-sm m-2 ">
                <div class="card-container d-flex justify-content-center">
                    <div class="p-3 neu-btn ">
                        <a href="<?= site_url() . 'projects/' ?>">
                            <div class="front d-flex flex-column align-items-center justify-content-center neu neu-btn" style="width: 160px; height: 160px;">
                                <img src="./public/img/<?= $skill['img'] ?>" alt="" style="width: 100px">
                                <span>
                                    <ul class="list-unstyled d-flex justify-content-center">
                                        <?php for ($i = 0; $i < $skill['stars']; $i++) { ?>
                                            <li class=""><img src=" ./public/img/star.png" style="width:20px;">
                                            </li>
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