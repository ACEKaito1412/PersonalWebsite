<div class="d-flex flex-column w-100 h-auto justify-content-center">
    <!-- Project Card 1 -->
    <div class="d-flex flex-column flex-lg-row m-4  neu-inset">
        <div class="overflow-hidden p-3" style="width: 100%; aspect-ratio: 1/1;">
            <img src="<?= site_url() . 'public/uploads/' . $project['img_src'] ?>" alt="..." style="height:85%;">
        </div>
        <div class="d-flex justify-content-center flex-column p-3 w-100 w-lg-50">
            <h5 class="card-title"><?= $project['title'] ?></h5>
            <p class="card-text p-color mt-2"><?= $project['description']  ?></p>
            <div class="d-flex flex-row">
                <?php
                $categories = json_decode($project['category'], true);
                foreach ($categories as $category) { ?>
                    <p class="p-2 fs-6"><?= $category['category'] ?></p>
                <?php } ?>
            </div>
            <a href="<?= site_url('/projects/' . $project['id']) ?>" class="btn neu neu-btn">Go somewhere</a>
        </div>
    </div>
</div>