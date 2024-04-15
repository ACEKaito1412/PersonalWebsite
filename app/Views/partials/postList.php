<?php

$title = '';
$body = '';
$date = '';
foreach ($item as $i) {
    if ($i['type'] == 'h1') {
        $title = $i['content'];
    };

    if ($i['type'] == 'p'  && $body == '') {
        $body = $i['content'];
    }

    if ($i['type'] == 'span') {
        $date = $i['content'];
    }
}
?>
<a href="<?= site_url('all_post/' . $id) ?>" style="text-decoration: none;">
    <div class="card d-flex justify-content-center p-4 mb-3 neu neu-btn text-right" id="content">
        <h4 class="fw-bolder" style="color: gray"><?= $title ?></h4>
        <span class="small my-2"><?= $date ?></span>
        <p class="fw-small overflow-hidden" style="height: 20px;"><?= $body ?></p>
    </div>
</a>