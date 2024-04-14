<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="<?= site_url() ?>/public/js/utils.js"></script>
<script src="<?= site_url() ?>/public/js/create_post.js?version=8"></script>
<script>
    function createImageTwo(input) {
        console.log('Create Image');
        var file = input.files[0];
        var formData = new FormData();
        formData.append('image', file);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', '<?= site_url('upload_image') ?>', true);

        xhr.upload.onprogress = function(event) {
            if (event.lengthComputable) {
                var percentComplete = (event.loaded / event.total) * 100;
                document.getElementById('status').textContent = 'Uploading: ' + percentComplete.toFixed(2) + '%';
            }
        };

        xhr.onload = function() {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);


                console.log('Upload complete!');
                var content = document.getElementById('content');
                var imageContainer = document.createElement('div');
                var image = document.createElement('img');
                image.src = "<?= base_url() . 'public/uploads/'  ?>" + response.filePath;
                image.className = 'img-fluid'; // Add Bootstrap class for responsive images
                imageContainer.className = 'position-relative mb-2 mt-2';
                var badge = createRemoveBadge();
                addRemoveBadge(imageContainer, badge);

                imageContainer.appendChild(image)
                content.appendChild(imageContainer);

                document.getElementById('status').textContent = "<?= base_url() . 'public/uploads/'  ?>" + response.filePath;
            } else {
                document.getElementById('status').textContent = 'Upload failed: ' + xhr.statusText;
            }
        };

        xhr.onerror = function() {
            document.getElementById('status').textContent = 'Request failed';
        };

        xhr.send(formData);
    }

    function deleteContent(id, type) {
        var formData = new FormData();

        var xhr = new XMLHttpRequest();
        xhr.open('POST', '<?= site_url("delete_item") ?>');

        xhr.onload = function() {
            if (xhr.status == 200) {
                console.log(xhr.responseText);
                window.location.href = '<?= base_url() . 'all_post' ?>';
            } else {
                console.log('Error Saving: ', xhr.statusText);
            }
        }

        formData.append('id', id);
        formData.append('type', type);

        xhr.send(formData);
    }

    function saveContent(id, update, type) {
        var content = document.getElementById('content');
        var elements = content.children;
        var formData = new FormData();
        var data = [];

        for (var i = 0; i < elements.length; i++) {
            var element = elements[i];
            var elementType = element.tagName.toLowerCase();
            var elementContent = element.textContent;

            if (elementType == 'div') {
                var imgElement = element.getElementsByTagName('img');

                for (var j = 0; j < imgElement.length; j++) {
                    var imgSrc = imgElement[j].getAttribute('src');
                    var fileName = imgSrc.substring(imgSrc.lastIndexOf('/') + 1);

                    data.push({
                        type: 'img',
                        content: fileName
                    })
                }

            } else if (elementType == 'ul') {
                var li = element.children;
                var li_array = [];
                for (var j = 0; j < li.length; j++) {
                    var text_content = li[j].textContent;
                    li_array.push({
                        type: 'li',
                        content: text_content
                    })
                }

                data.push({
                    type: 'ul',
                    content: JSON.stringify(li_array)
                })
            } else {
                data.push({
                    type: elementType,
                    content: elementContent
                });
            }
        }

        console.log(data);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', '<?= site_url("save_item") ?>');

        xhr.onload = function() {
            if (xhr.status == 200) {
                console.log(xhr.responseText);
                location.reload();
            } else {
                console.log('Error Saving: ', xhr.statusText);
            }
        }

        var json_data = JSON.stringify(data);
        formData.append('json_data', json_data);
        formData.append('transaction', update);
        formData.append('id', id);
        formData.append('type', type);

        xhr.send(formData);
    }

    <?php
    if ($page == 'pages/openProject' && $admin) {
        if ($project['content'] == '') { ?>
            createTitleOne('Project Title');
            createParagraph('Overview');
            createParagraph('[Provide a brief overview of your project. What does it solve? What is its purpose?]');
            createTitleTwo('Key Features');
            createUIElement('Feature ');
            createTitleTwo('Technologies Used');
            createUIElement('Technology ');
            createTitleTwo('Demo');
            createParagraph('[If applicable provide a link to a live demo of your project.]');
            createTitleTwo('GitHub Repository');
            createParagraph('[Provide a link to the GitHub repository of your project for users who want to explore the code.]');
    <?php }
    }
    ?>
</script>

</body>

</html>