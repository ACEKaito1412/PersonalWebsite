<?php
$url = current_url();
$path = parse_url($url, PHP_URL_PATH);
$segments = explode('/', $path);
?>

<div class="d-flex flex-column mt-5 mb-2">
    <nav aria-label="breadcrumb" class="d-flex w-100 align-items-center justify-content-between neu-inset p-2" style="height: 80px">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item p-2"><a href="<?= site_url() ?>" class="m-0" style="text-decoration: none; color: gray;">HOME</a></li>
            <?php for ($i = 1; $i < count($segments); $i++) {
                $url_path = '';
                for ($j = 1; $j <= $i; $j++) {
                    $url_path .= '/' . $segments[$j];
                }
            ?>
                <li class="breadcrumb-item p-2"><a href="<?= site_url($url_path) ?>" style="text-decoration: none; color:gray;"><?= strtoupper($segments[$i]) ?></a></li>
            <?php } ?>
        </ol>
        <div class="px-2 py-1 rounded neu m-2" style="background-color: #21262d;">
            <i class="fas fa-moon m-1" id="dark" onclick="changeTheme(event)"></i>
            <i class="fas fa-sun m-1" id="light" onclick="changeTheme(event)"></i>
        </div>
    </nav>
</div>