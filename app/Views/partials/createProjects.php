<div class="d-flex flex-column w-100 h-auto justify-content-center">
    <div class="d-flex flex-row m-4  neu-inset rounded">
        <div class="overflow-hidden  p-3" style="width: 300px; height: 300px">
            <img id="projectImg" src="<?= base_url() . 'public/img/upload-solid.png' ?>" alt="..." style="height:100%;" onclick="document.getElementById('inputProjectImg').click()">
            <input type="file" name="" id="inputProjectImg" style="display: none;" onchange="uploadImage()">
        </div>
        <div class="d-flex justify-content-center flex-column p-3 w-50">
            <h5 class="card-title" id="title" contenteditable="true">Create new project</h5>
            <p class="card-text" id="description" contenteditable="true">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <div class="d-flex flex-column flex-lg-row" style="list-style-type: none" id="category" contenteditable="true">
                <p class="p-2 fs-6">HTML</p>
                <p class="p-2 fs-6">Javascript</p>
                <p class="p-2 fs-6">MYSQL</p>
            </div>
            <a onclick="saveProject()" id="saveBtn" class="btn btn-primary">Save Project</a>
        </div>
    </div>
</div>
<script>
    function uploadImage() {
        var image = document.getElementById('inputProjectImg');
        var formData = new FormData();
        formData.append('image', image.files[0]);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', "<?= site_url('upload_image') ?>", true);

        xhr.onprogress = function() {
            var projectImg = document.getElementById('projectImg');
            projectImg.src = '<?= base_url() . "public/img/loading.gif" ?>';
        }

        xhr.onload = function() {
            var response = JSON.parse(xhr.responseText);

            if (xhr.status == 200) {
                var projectImg = document.getElementById('projectImg');
                console.log('ok' + response.filePath);
                projectImg.src = "<?= base_url() . 'public/uploads/'  ?>" + response.filePath;
            } else {
                console.log('not ok');
            }
        }

        xhr.send(formData);
    }

    function saveProject() {
        var image = document.getElementById('projectImg').src;
        var title = document.getElementById('title').textContent;
        var description = document.getElementById('description').textContent;
        var category = document.getElementById('category').children;

        var catArray = [];
        for (var i = 0; i < category.length; i++) {
            var textContent = category[i].textContent;
            catArray.push({
                category: textContent
            });
        }

        var filename = image.substring(image.lastIndexOf('/') + 1)

        var formData = new FormData();
        formData.append('image', filename);
        formData.append('title', title);
        formData.append('description', description);
        formData.append('category', JSON.stringify(catArray));

        var xhr = new XMLHttpRequest();
        xhr.open('POST', "<?= site_url('save_project') ?>", true);

        xhr.onprogress = function() {
            var saveBtn = document.getElementById('saveBtn');
            saveBtn.disabled = true;
        }

        xhr.onload = function() {
            if (xhr.status == 200) {
                var response = JSON.parse(xhr.responseText);
                console.log(response.message);
                location.reload();
            } else {
                console.log("Not Ok");
            }
        }

        xhr.send(formData);
    }
</script>