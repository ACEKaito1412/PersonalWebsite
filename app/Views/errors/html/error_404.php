<?php
$data = [
    'page_title' => lang('Errors.pageNotFound')
];
echo view('/partials/header', $data)

?>

<body class="d-flex h-100 justify-content-center">
    <div class="d-flex justify-content-center flex-column align-items-center" style="width: 400px;">
        <h1>404</h1>
        <a href="<?= site_url('/') ?>" class="btn m-2 neu neu-btn">Go Back</a>
        <p>
            <?php if (ENVIRONMENT !== 'production') : ?>
                <?= nl2br(esc($message)) ?>
            <?php else : ?>
                <?= lang('Errors.sorryCannotFind') ?>
            <?php endif; ?>
        </p>
    </div>
</body>

</html>