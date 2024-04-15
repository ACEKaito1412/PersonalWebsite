<section class="container">
    <div class="row d-flex justify-content-center" id="">
        <div class="col-10 col-sm-4">
            <div class="pt-5 sticky-top">
                <div class=" mb-4 text-center text-lg-start">
                    <a class="flex-shrink-0 mb-lg-3 link-dark text-decoration-none text-center" href="<?= site_url('/') ?>" aria-label="logo">
                        <img class="bd-booticon d-block mx-auto mb-3 mx-lg-0" src="<?= site_url() ?>/public/logo.png" alt="Bootstrap" width="200" height="165" />
                    </a>
                    <div class="ms-3 ms-lg-0">
                        <h1 class="mb-1 mb-lg-2 f1 fw-600 my-color">I'm Jhun Carlo Macdon</h1>
                        <p class="col-sm-8 col-lg-12 mx-auto mb-0 mb-lg-4" style="color: gray;">
                            Welcome to my profile, my Skills,
                            <a href="<?= base_url('projects') ?>" title="Visit my Projects">Projects</a>, and some
                            <a href="<?= base_url('all_post') ?>" title="Check out some of my post">Tutorials</a> will be uploaded in the future.
                        </p>
                    </div>
                </div>

                <nav class="nav nav-pills justify-content-center flex-lg-column justify-content-lg-start gap-1 sidebar-nav">
                    <a class="btn d-flex align-items-center fw-semibold m-2 neuhover <?= $page == 'pages/home' ? 'n-active' : '' ?>" href="<?= site_url('/') ?>">
                        <i class="fa-solid fa-house me-2 f5" style="color: purple;"></i>
                        Home
                    </a>
                    <a class="btn d-flex align-items-center fw-semibold m-2 neuhover <?= $page == 'pages/post' ? 'n-active' : '' ?>" href="<?= site_url('/all_post') ?>">
                        <i class="fa-solid fa-file-lines me-2 f5" style="color: purple"></i>
                        All Post
                    </a>
                    <a class="btn d-flex align-items-center fw-semibold m-2 neuhover <?= $page == 'pages/projects' ? 'n-active' : '' ?>" href="<?= site_url('/projects') ?>">
                        <i class="fa-solid fa-list-check me-2 f5" style="color: purple"></i>
                        Projects
                    </a>
                    <?php if ($admin) { ?>
                        <a class="btn d-flex align-items-center fw-semibold m-2 neuhover <?= $page == 'pages/messages' ? 'n-active' : '' ?>" href="<?= site_url('/messages') ?>">
                            <i class="fa-solid fa-message me-2 f5" style="color: purple"></i>
                            Messages
                        </a>
                    <?php } ?>

                </nav>
            </div>
        </div>

        <div class="col-10 col-sm-4 flex-grow-1">
            <div class="d-flex flex-column mx-auto w-100 pt-5">
                <?php

                if ($breadCrumbs) {
                    echo view('/partials/breadCrumbs');
                }

                echo view($page) ?>
            </div>
        </div>
</section>