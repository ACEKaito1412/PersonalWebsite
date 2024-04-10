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
    </div>

    <?php if ($page == 'pages/post') { ?>
        <div class="d-flex flex-row justify-content-end mb-4">
            <button class="btn neu neu-btn" onclick="saveContent(0, 'new', 'post')">Add Post</button>
        </div>
    <?php } ?>
</div>