<div class="row d-flex flex-row justify-content-center mt-5 mb-2 p-2 h-auto">
    <div class="col-4 h-50 h-lg-100 flex-grow-1 flex-lg-grow-0">
        <style>
            .remove-scrollbar::-webkit-scrollbar {
                display: none;
            }
        </style>
        <h4 class="border-bottom border-dark-subtle pb-2">Sender</h4>
        <ul class="list-unstyled overflow-y-scroll remove-scrollbar" style="height: 285px; box-shadow: inset 0px -10px 18px -3px rgba(0,0,0,0.1);">
            <?php foreach ($messages as $message) { ?>
                <li class="p-1 border border-dark-subtle rounded mt-2 border d-flex flex-row align-items-center neuhover" onclick="seeMsg(<?= $message['id'] ?>)">
                    <div class=" rounded-circle border d-flex align-items-center justify-content-center" style="width: 30px; aspect-ratio: 1/1; font-weight: bolder;"><?= strtoupper(substr($message['name'], 0, 1)) ?></div>
                    <div class="mx-3">
                        <?= $message['name'] ?>
                    </div>
                </li>
            <?php } ?>
        </ul>
    </div>
    <div class="col d-flex flex-column neu-inset p-3 ">
        <div class="d-flex flex-row justify-content-between align-items-center neu">
            <div class="p-2 text-uppercase" id="name"><?= $messages[0]['name']  ?></div>
            <div class="p-2 " id="email"><?= $messages[0]['email']  ?></div>
        </div>
        <div class="p-4 mt-2 overflow-y-scroll remove-scrollbar " style="height: 300px; box-shadow: inset 0px -10px 18px -3px rgba(0,0,0,0.1);">
            <p id="body"><?= $messages[0]['body']  ?></p>
        </div>
        <div class="mt-3 d-flex justify-content-end">
            <button class="btn neu neu-btn">Open Gmail</button>
        </div>
    </div>
</div>

<script>
    function seeMsg(id) {
        var formData = new FormData();

        var xhr = new XMLHttpRequest();
        xhr.open('POST', "<?= site_url('/open_message') ?>");

        formData.append('id', id);

        xhr.onload = function() {
            if (xhr.status == 200) {
                var response = JSON.parse(xhr.responseText);

                var name = response.name;
                var email = response.email;
                var body = response.body;

                document.getElementById('name').textContent = name;
                document.getElementById('email').textContent = email;
                document.getElementById('body').textContent = body;

            } else {

            }
        }

        xhr.send(formData);
    }
</script>