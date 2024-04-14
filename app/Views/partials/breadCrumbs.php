<?php
$url = current_url();
$path = parse_url($url, PHP_URL_PATH);
$segments = explode('/', $path);
?>

<div class="d-flex flex-column mt-5">
    <nav aria-label="breadcrumb" style="height: 80px">
        <ol class="breadcrumb d-flex w-100 align-items-center neu-inset p-2">
            <li class="breadcrumb-item p-2"><a href="<?= site_url() ?>" style="text-decoration: none; color: black;">HOME</a></li>
            <?php for ($i = 2; $i < count($segments); $i++) {
                $url_path = '';
                for ($j = 2; $j <= $i; $j++) {
                    $url_path .= '/' . $segments[$j];
                }
            ?>
                <li class="breadcrumb-item p-2"><a href="<?= site_url($url_path) ?>" style="text-decoration: none; color:black;"><?= strtoupper($segments[$i]) ?></a></li>
            <?php } ?>
        </ol>
    </nav>
</div>