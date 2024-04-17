<div class="d-flex flex-column mt-3">
    <div class="d-flex flex-row justify-content-between mb-3">
        <button class="btn" type="button" onclick="createTitleOne()">
            Title I
        </button>
        <button class="btn" type="button" onclick="createTitleTwo()">
            Title II
        </button>
        <button class="btn" type="button" onclick="createDate()">
            Date
        </button>
        <button class="btn" type="button" onclick="createParagraph()">
            Paragraph;
        </button>
        <button class="btn" type="button" onclick="createCodeBlock()">
            Code Block
        </button>
    </div>
    <div class="d-flex flex-row justify-content-between mb-3">
        <input type="file" id="imageInput" class="form-control visually-hidden" onchange="createImageTwo(this)">
        <label for="imageInput" class="btn">Image</label>
        <button class="btn" type="button" onclick="createUIElement()">
            Unlisted Element
        </button>
        <button class="btn" type="button" onclick="createLink()">
            Link
        </button>
    </div>
    <?php if ($page == 'pages/post') { ?>
        <div class="d-flex flex-row justify-content-end mb-4">
            <button class="btn neu neu-btn" onclick="saveContent(0, 'new', 'post')">Add Post</button>
        </div>
    <?php } ?>

    <div id="progress-container" style="display: none;">
        <h4 class="m-3 p-color">Uploading</h4>
        <div class="progress neu-inset m-3" role="progressbar" aria-label="Basic example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
            <div class="progress-bar bg-danger"></div>
        </div>
    </div>

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
</div>