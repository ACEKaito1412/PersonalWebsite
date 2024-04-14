<div class="row d-flex flex-column flex-lg-row align-content-center justify-content-center mt-2">
    <div class="row d-flex  flex-column flex-lg-row">
        <div class="col col-lg-4 " style="height: 400px;">
            <h3 class="py-2 border-bottom border-2 border-dark-subtle">Sender</h3>
            <ul class="list-unstyled overflow-y-scroll rmv-scroll msg-shadow" style="height: 280px;">
                <?php foreach ($messages as $message) { ?>
                    <li class="d-flex flex-row align-items-center border border-dark-subtle rounded p-2 mt-2 neuhover" onclick="openMsg(<?= $message['id'] ?>)">
                        <div class="px-3 fw-bolder text-uppercase"><?= substr($message['name'], 0, 1) ?></div>
                        <div>
                            <?= $message['name'] ?>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <div class="col d-flex flex-column justify-content-between  p-3 neu-inset rounded" style="height: 400px; ">
            <div class="d-flex justify-content-between rounded p-1 neu">
                <div class="text-uppercase " id="name"><?= $messages[0]['name'] ?></div>
                <div class="" id="email"><?= $messages[0]['email']  ?></div>
            </div>
            <div class="p-3 overflow-scroll rmv-scroll msg-shadow rounded mt-2" style="height: 280px;">
                <p id="body"><?= $messages[0]['body'] ?></p>
            </div>
            <div class="d-flex justify-content-end mt-2">
                <button class="btn neu neu-btn" onclick="sendMail()">Open Gmail</button>
            </div>
        </div>
    </div>
</div>

<?php
echo view('partials/footer-2')
?>
<script>
    function sendMail() {
        var formData = new FormData();
        var xhr = new XMLHttpRequest();

        formData.append("email", "jhuncarlomacdon@gmail.com");
        xhr.open('POST', "<?= site_url('/send_mail') ?>");
        xhr.onload = function() {
            if (xhr.status == 200) {
                console.log(xhr.responseText);
            }
        }

        xhr.send(formData);

    }


    function openMsg(id) {
        var formData = new FormData();
        var xhr = new XMLHttpRequest();

        formData.append('id', id);

        xhr.open("POST", "<?= site_url('open_message') ?>");
        xhr.onload = function() {
            if (xhr.status == 200) {
                var response = JSON.parse(xhr.responseText);

                console.log('Success: ' + response.message);
                document.getElementById('name').textContent = response.name;
                document.getElementById('email').textContent = response.email;
                document.getElementById('body').textContent = response.body;
            } else {
                var response = JSON.parse(xhr.responseText);
                console.log("Error: " + response.message)
            }
        }

        xhr.send(formData);
    }
</script>