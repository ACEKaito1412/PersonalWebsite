<?php
$data = [
    'page_title' => 'test'
];
echo view('partials/header', $data);

?>

<body>
    <div class="d-flex row align-content-center justify-content-center mt-2 bg-primary">
        <div class="col bg-danger flex-grow-0 p-2" id="selectedDiv">
            <div type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="storeId('placeholder')">
                <img src="placeholder.jpg" id="placeholder" alt="Selected Image" style="width: 290px; aspect-ratio: 1/1;">
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade neu" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content neu-inset" style="height: 90%; width: 100%">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Image Selection</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body row overflow-y-scroll justify-content-center rmv-scroll">
                    <?php
                    $decoded = json_decode($images);
                    foreach ($decoded as $images) : ?>
                        <div class="overflow-hidden col-lg-3 col-4 m-2 neu neu-btn" style="height: 80px; width:80px; padding: 0;">
                            <img src="<?= base_url() . 'public/uploads/' . $images ?>" alt="" style="height: 80px" onclick="selectImg(event)">
                            <input type="radio" name="imgSelected" value="<?= base_url() . 'public/uploads/' . $images ?>" class="input_radio" style="display:none">
                        </div>
                    <?php endforeach ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn neuhover" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn neu neu-btn" onclick="saveChanges()">Save changes</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script>
        let selectedImageSrc = '';
        let imageSrc = '';


        function storeId(ID) {
            selectedImageSrc = document.getElementById(ID);
        }

        function selectImg(ev) {
            var img = ev.target;
            var container = img.parentNode;
            container.classList.add('n-active');
            var input = container.querySelector('.input_radio');
            if (input) {
                input.checked = true; // Check the radio input
                imageSrc = input.value;
            } else {
                console.log('Radio input not found');
            }
            changeDisplay();
        }

        function changeDisplay() {
            var inputs = document.querySelectorAll('.input_radio');
            for (var i = 0; i < inputs.length; i++) {
                var input = inputs[i];

                if (!input.checked) {
                    var parentNode = input.parentElement;
                    parentNode.classList.remove('n-active');
                }
            }
        }

        function saveChanges() {
            var imgContainer = document.querySelector('#placeholder');
            imgContainer.src = imageSrc;
            document.body.classList.remove('modal-open');
        }
    </script>
</body>

</html>