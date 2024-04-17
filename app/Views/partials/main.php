<div class="row d-flex flex-column flex-lg-row justify-content-center ">
    <div class="col-sm mt-5 ">
        <div class="card d-flex justify-content-center align-items-center  text-center p-2 neu-inset">
            <div class="d-flex justify-content-center align-items-center rounded-circle neu-inset overflow-hidden mt-2" style="width: 300px; height:300px">
                <div class="rounded-circle bg-dark overflow-hidden neu" style="width: 260px; height:260px">
                    <img src="./public/Profile.jpg" class="card-img-top" alt="...">
                </div>
            </div>

            <div class="card-body">
                <h3 class="h5 mb-2">Jhun Carlo Macdon</h3>
                <span class="h6 font-weight-normal text-gray mb-3">Junior Developer</span>
                <ul class="list-unstyled d-flex justify-content-center my-3">
                    <li>
                        <a href="https://github.com/ACEKaito1412" target="_blank" class="mx-3">
                            <i class="fa-brands fa-github fs-3"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.linkedin.com/in/macdon-jhun-carlo-34670a26b" target="_blank" aria-label="social link" class="  mx-3" style="color: #7ce38b;">
                            <i class="fa-brands fa-linkedin fs-3"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.facebook.com/jhuncarlo.macdon.7" target="_blank" aria-label="social link" class="  mx-3">
                            <i class="fa-brands fa-facebook fs-3"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-sm mt-5 d-flex">
        <div class="d-flex flex-column">
            <div class=" m-2">
                <h3 class="my-color p-1">Who I am?</h3>
                <div class="card shadow-soft border-none bg-neu neu">
                    <div class="card-body">
                        <p class="card-text p-color">
                            Motivated Junior Software Developer with experience in mobile app development, machine learning concepts, database management and proficient in web developement using Python and PHP.
                        </p>
                    </div>
                </div>
            </div>
            <div class="m-2">
                <h3 class="p-1 my-color">Latest Post</h3>
                <?php foreach ($posts as $post) : ?>
                    <a href="<?= site_url('/all_post/' . $post['id']) ?>" class="d-flex align-content-center flex-wrap neu neu-btn my-3" style="text-decoration: none;">
                        <div class="d-flex justify-content-center align-items-center p-2">
                            <p class="m-0 p-color"><?= $post['head'] ?></p>
                        </div>
                    </a>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>