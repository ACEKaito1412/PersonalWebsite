<div class="row d-flex flex-column flex-lg-row justify-content-between mt-5 mb-3  p-lg-0 p-4 ">
    <div class="accordion mt-4" id="accordion">
        <div class="accordion-item bg-neu neu-inset p-2 ">
            <div id="send-message" class="accordion-collapse collapse " data-bs-parent="#accordion">
                <div class="row d-flex flex-column flex-lg-row">
                    <div class="col col-lg-4 d-flex flex-column justify-content-center">
                        <h1 class="m-3">Let's discuss something together.</h1>
                        <div class="m-3">
                            <p class=" my-2 p-2">macdon.jc.bscs@gmail.com</p>
                            <span class="p-2 my-3">+639774249341</span>
                        </div>
                        <ul class="list-unstyled d-flex justify-content-center m-3">
                            <li class="neu py-2 rounded-circle">
                                <a href="https://github.com/ACEKaito1412" target="_blank" class="mx-3">
                                    <i class="fa-brands fa-github fs-4"></i>
                                </a>
                            </li>
                            <li class="py-2">
                                <a href="https://www.linkedin.com/in/macdon-jhun-carlo-34670a26b" target="_blank" aria-label="twitter social link" class="  mx-3" style="color:firebrick">
                                    <i class="fa-brands fa-linkedin fs-4"></i>
                                </a>
                            </li>
                            <li class="py-2">
                                <a href="https://www.facebook.com/jhuncarlo.macdon.7" target="_blank" aria-label="social link" class="  mx-3">
                                    <i class="fa-brands fa-facebook fs-4"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col">
                        <h1 class="m-3">Contact Me</h1>
                        <form method="post" id="send-message-form" onsubmit="send_message(event)">
                            <div class="m-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control neu-input " name="name" id="name" required>
                            </div>
                            <div class="m-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control neu-input " required>
                            </div>
                            <div class="m-3">
                                <label for="subject" class="form-label">Subject</label>
                                <input type="text" name="subject" id="subject" class="form-control neu-input " required>
                            </div>
                            <div class="m-3">
                                <label for="body" class="form-label">Message</label>
                                <textarea name="body" id="body" cols="20" rows="10" class="form-control neu-input " required></textarea>
                            </div>
                            <div id="progress-container" style="display:none;">
                                <h4 class="m-3 p-color">Sending</h4>
                                <div class="progress neu-inset m-3" role="progressbar" aria-label="Basic example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar bg-danger"></div>
                                </div>
                            </div>
                            <div class="m-3">
                                <button class="btn neu neu-btn p-color">Send Message</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col d-flex flex-grow-1">
        <div class=" py-5 px-2">
            <h2 class="mb-3 my-color">Jhun Carlo Macdon</h2>
            <p class="mb-0 p-color" style="font-size: 14px">Hi! Thanks for visiting my page. I'd like to add more flavor in the future and lots of spice.</p>
        </div>
        <div class=" px-5 py-5">
            <h4 class="border-bottom border-2 py-2 my-color">Page Links</h4>
            <ul style="list-style-type: none; margin:0; padding: 0;">
                <li><a href="<?= base_url('/') ?>" style="text-decoration: none;" class="p-color">Home</a></li>
                <li><a href="<?= base_url('/all_post') ?>" style="text-decoration: none;" class="p-color">Post</a></li>
                <li><a href="<?= base_url('/projects') ?>" style="text-decoration: none;" class="p-color">Projects</a></li>
            </ul>
        </div>
    </div>
    <div class="col flex-grow-1">
        <div class="row align-items-center neu mt-5">

            <div class="col py-4 px-4" id="msgSent" style="display: none;">
                <h2 class="mb-3" style="color: green;">Message Sent!</h2>
                <p class="mb-3 p-color" style="font-size: 14px;">Thank you for reaching out! Your message has been successfully sent.</p>
            </div>

            <div class="col py-4 px-4" id="msgErrorOccured" style="display: none;">
                <h2 class="mb-3" style="color: red;">Ow Snap!</h2>
                <p class="mb-3 " style="font-size: 14px;">Something went wrong when we're trying to send the message, please use other method to contact me.</p>
                <p class="mb-1 p-color" style="font-size: 14px;">Email: macdon.jc.bscs@gmail.com</p>
                <p class="mb-1 p-color" style="font-size: 14px;">Phone: 09774249341</p>
            </div>

            <div class="col py-3 px-3" id="msgNotSent" style="display: none;">
                <h2 class="mb-3 my-color">Get in touch</h2>
                <p class="mb-0 p-color" style="font-size: 14px;">If you need any help with your services and wanted to reach out please contact me.</p>
                <div class="mt-3 text-md-right">
                    <button class="btn neu neu-btn p-color" id="btnSubmit" type="button" data-bs-toggle="collapse" data-bs-target="#send-message" aria-expanded="false" aria-controls="send-message" <?= $admin ? "disabled" : "" ?> ?>>
                        <span class="mr-1"><span class="fas fa-headphones"></span> </span>
                        Contact Me
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var msgStatus = localStorage.getItem('msgStatus');

    console.log(msgStatus);

    if (msgStatus) {
        if (msgStatus) {
            console.log('true')
            var contaier = document.getElementById('msgSent');
            contaier.style.display = "block";
        } else {
            console.log('false')
            var contaier = document.getElementById('msgErrorOccured');
            contaier.style.display = "block";
        }
    } else {
        var contaier = document.getElementById('msgNotSent');
        contaier.style.display = "block";
    }

    function send_message(event) {
        event.preventDefault();

        var form = event.target;
        var formData = new FormData(form);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', "<?= site_url('send_message') ?>")

        xhr.onprogress = function() {
            //lets prevent the clicking of the submit btn again
            var container = document.querySelector('#progress-container');
            contaier.style.display = 'block';
            var constainer = document.querySelector('.progress-bar');
            var btn = document.getElementById('btnSubmit');
            btn.disabled = true;
            if (event.lengthComputable) {
                var percentComplete = (event.loaded / event.total) * 100;
                progress.style.width = percentComplete.toFixed(2) + "%";
            }
        }

        xhr.onload = function() {
            if (xhr.status == 200) {
                var response = JSON.parse(xhr.responseText);
                console.log(response.message);

                var btn = document.getElementById('btnSubmit');
                btn.disabled = false;

                localStorage.setItem('msgStatus', true);
                var container = document.querySelector('#progress-container');
                contaier.style.display = 'block';
                location.reload();
            } else {
                var response = JSON.parse(xhr.responseText);
                console.log(response.message);
                var btn = document.getElementById('btnSubmit');
                btn.disabled = false;
                console.log('Error: ' + response.message);

                localStorage.setItem('msgStatus', false);
                var container = document.querySelector('#progress-container');
                contaier.style.display = 'block';
                location.reload();
            }
        }

        xhr.send(formData);
    }
</script>