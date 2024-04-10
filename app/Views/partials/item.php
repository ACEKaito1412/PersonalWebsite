<?php

use CodeIgniter\HTTP\SiteURI;

function random_string($length = 8)
{
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $random_string = '';
    for ($i = 0; $i < $length; $i++) {
        $random_string .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $random_string;
}

function generate_editable($id)
{ ?>
    <i class="btn position-absolute top-50 end-0 translate-middle-y fa-solid fa-circle-xmark" aria-hidden="true" style="display: none; font-size: 20px;"></i>
<?php }
?>

<div class="col-sm mt-2 mb-3">
    <div class="card d-flex justify-content-center p-4 neu-inset text-right" id="content">
        <?php
        foreach ($item as $i) {
            if ($i['type'] == 'h1') {
                $randName = random_string(8);
        ?>
                <h1 class="fw-bolder position-relative" <?php if ($admin && $page != 'pages/post') { ?> contenteditable="true" id="<?= $randName ?>" onmouseenter="mouseEnter(event, '<?= $randName ?>')" onmouseleave="mouseLeave(event)" <?php } ?>><?= $i['content'] ?> <?php generate_editable($randName); ?> </h1>
            <?php }
            if ($i['type'] == 'h3') {
                $randName = random_string(8);
            ?>
                <h3 class="fw-bolder position-relative" <?php if ($admin && $page != 'pages/post') { ?> contenteditable="true" id="<?= $randName ?>" onmouseenter="mouseEnter(event, '<?= $randName ?>')" onmouseleave="mouseLeave(event)" <?php } ?>><?= $i['content'] ?> <?php generate_editable($randName); ?> </h3>
            <?php }
            if ($i['type'] == 'p') {
                $randName = random_string(8);
            ?>
                <p class="fw-small position-relative" <?php if ($admin && $page != 'pages/post') { ?> contenteditable="true" id="<?= $randName ?>" onmouseenter="mouseEnter(event, '<?= $randName ?>')" onmouseleave="mouseLeave(event)" <?php } ?>><?= $i['content'] ?><?php generate_editable($randName); ?></p>
            <?php }
            if ($i['type'] == 'pre') {
                $randName = random_string(8);
            ?>
                <pre class="code position-relative" <?php if ($admin && $page != 'pages/post') { ?> contenteditable="true" id="<?= $randName ?>" onmouseenter="mouseEnter(event, '<?= $randName ?>')" onmouseleave="mouseLeave(event)" <?php } ?>><?= $i['content'] ?><?php generate_editable($randName); ?></pre>
            <?php
            }
            if ($i['type'] == 'span') {
                $randName = random_string(8);
            ?>
                <span class="small my-2 border position-relative" <?php if ($admin && $page != 'pages/post') { ?> contenteditable="true" id="<?= $randName ?>" onmouseenter="mouseEnter(event, '<?= $randName ?>')" onmouseleave="mouseLeave(event)" <?php } ?>><?= $i['content'] ?><?php generate_editable($randName); ?></span>
            <?php }
            if ($i['type'] == 'img') {
                $randName = random_string(8);
            ?>
                <div class="position-relative mb-2 mt-2" <?php if ($admin && $page != 'pages/post') { ?> contenteditable="true" id="<?= $randName ?>" onmouseenter="mouseEnter(event, '<?= $randName ?>')" onmouseleave="mouseLeave(event)" <?php } ?>>
                    <img src="<?= base_url() . 'public/uploads/' . $i['content']  ?>" class="img-fluid">
                    <?php generate_editable($randName); ?>
                </div>
            <?php }
            if ($i['type'] == 'ul') {
                $randName = random_string(8);
            ?>
                <ul class="position-relative mb-2 mt-2" <?php if ($admin && $page != 'pages/post') { ?> contenteditable="true" id="<?= $randName ?>" onmouseenter="mouseEnter(event, '<?= $randName ?>')" onmouseleave="mouseLeave(event)" <?php } ?>>
                    <?php
                    generate_editable($randName);
                    $ulContent = json_decode($i['content'], true);
                    foreach ($ulContent as $j) { ?><li><?= $j['content'] ?></li><?php } ?>
                </ul>
        <?php }
        }
        ?>
    </div>
</div>
<?php
$data = [
    'page' => $page
];


if ($page != 'pages/post' &&  $admin) {
    echo view('/partials/createButtons', $data);
?>
    <div class="d-flex flex-row justify-content-end mt-2 mb-3">
        <button class="btn neu neu-btn mx-3" onclick="deleteContent(<?= $id ?>, '<?= $type ?>')">Delete</button>
        <button class="btn neu neu-btn" onclick="saveContent(<?= $id ?>, 'update', '<?= $type ?>')">Save Changes</button>
    </div>
<?php }
?>

<script>
    function mouseEnter(event, id) {
        var element = event.target;
        var elements = element.getElementsByTagName('i');

        elements[0].style.display = 'inline-block';
        elements[0].addEventListener('click', function() {
            var removeElement = document.getElementById(id);
            console.log(removeElement);
            removeElement.remove();
        })
    }

    function mouseLeave(event) {
        var element = event.target;
        var elements = element.getElementsByTagName('i');

        elements[0].style.display = 'none';
    }
</script>