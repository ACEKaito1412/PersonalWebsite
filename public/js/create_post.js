function createEditableElement(tagName, textContent, className) {
  var element = document.createElement(tagName);
  element.textContent = textContent;
  element.className = className;
  element.contentEditable = true;
  return element;
}

function createRemoveBadge() {
  var badge = document.createElement("i");
  badge.className =
    "btn position-absolute top-50 end-0 translate-middle-y fa-solid fa-circle-xmark";
  badge.style.display = "none"; // Initially hide the badge
  badge.style.fontSize = "20px";
  return badge;
}

function addRemoveBadge(element, badge) {
  element.addEventListener("mouseenter", function () {
    badge.style.display = "inline-block";
  });

  element.addEventListener("mouseleave", function () {
    badge.style.display = "none";
  });

  badge.addEventListener("click", function () {
    element.remove();
  });

  element.appendChild(badge);
}

function createTitleOne(textContent = "This is A Title") {
  var content = document.getElementById("content");
  console.log("Created Title");
  var titleElement = createEditableElement(
    "h1",
    textContent,
    "fw-bolder position-relative"
  );
  var badge = createRemoveBadge();
  addRemoveBadge(titleElement, badge);
  content.appendChild(titleElement);
}

function createTitleTwo(textContent = "This is Title Two") {
  var content = document.getElementById("content");
  console.log("Created Title");
  var titleElement = createEditableElement(
    "h3",
    textContent,
    "fw-bolder position-relative"
  );
  var badge = createRemoveBadge();
  addRemoveBadge(titleElement, badge);
  content.appendChild(titleElement);
}

function createLink(textContent = "https://google.com") {
  var content = document.getElementById("content");
  console.log("Created Title");
  var linkElement = createEditableElement(
    "a",
    textContent,
    "fw-bolder position-relative"
  );

  linkElement.href = textContent;
  linkElement.target = "_blank";
  linkElement.addEventListener("input", function () {
    linkElement.href = linkElement.textContent;
    console.log("change");
  });
  var badge = createRemoveBadge();
  addRemoveBadge(linkElement, badge);
  content.appendChild(linkElement);
}

function createUIElement(textContent = "Content") {
  var content = document.getElementById("content");
  console.log("Created Unlisted Element");
  var unlisteElement = createEditableElement("ul", "", "position-relative");
  var liElement = document.createElement("li");
  liElement.textContent = "Content";
  for (var i = 0; i < 3; i++) {
    var liElement = document.createElement("li");
    liElement.textContent = textContent + i;
    unlisteElement.appendChild(liElement);
  }

  var badge = createRemoveBadge();
  addRemoveBadge(unlisteElement, badge);
  content.appendChild(unlisteElement);
}

function createDate() {
  var date = new Date();
  var content = document.getElementById("content");
  console.log("Created Date");
  var spanElement = createEditableElement(
    "span",
    date.getDate() + "/" + (date.getMonth() + 1) + "/" + date.getFullYear(),
    "small my-2 border position-relative"
  );
  var badge = createRemoveBadge();
  addRemoveBadge(spanElement, badge);
  content.appendChild(spanElement);
}

function createParagraph(
  textContent = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it"
) {
  var content = document.getElementById("content");
  console.log("Created Paragraph");
  var paragraphElement = createEditableElement(
    "p",
    textContent,
    "fw-small position-relative"
  );
  var badge = createRemoveBadge();
  addRemoveBadge(paragraphElement, badge);
  content.appendChild(paragraphElement);
}

function createCodeBlock() {
  var content = document.getElementById("content");
  console.log("Created Code Block");
  var codeElement = createEditableElement(
    "pre",
    '// This is a sample code block\nfunction greet(name) {\n    return "Hello, " + name + "!";\n}\nconsole.log(greet("World"));',
    "code position-relative"
  );
  var badge = createRemoveBadge();
  addRemoveBadge(codeElement, badge);
  content.appendChild(codeElement);
}

function createImageTwo(input) {
  console.log("Create Image");
  var file = input.files[0];
  var formData = new FormData();
  formData.append("image", file);

  var xhr = new XMLHttpRequest();
  xhr.open("POST", urlLocation + "upload_image", true);

  xhr.upload.onprogress = function (event) {
    var container = document.querySelector("#progress-container");
    container.style.display = "block";

    var progress = document.querySelector(".progress-bar");
    if (event.lengthComputable) {
      var percentComplete = (event.loaded / event.total) * 100;
      progress.style.width = percentComplete.toFixed(2) + "%";
    }
  };

  xhr.onload = function () {
    if (xhr.status === 200) {
      var container = document.querySelector("#progress-container");
      container.style.display = "none";
      var response = JSON.parse(xhr.responseText);

      console.log("Upload complete!");
      var content = document.getElementById("content");
      var imageContainer = document.createElement("div");
      var image = document.createElement("img");
      image.src = urlLocation + "/public/uploads/" + response.filePath;
      image.className = "img-fluid"; // Add Bootstrap class for responsive images
      imageContainer.className = "position-relative mb-2 mt-2";
      var badge = createRemoveBadge();
      addRemoveBadge(imageContainer, badge);

      imageContainer.appendChild(image);
      content.appendChild(imageContainer);

      document.getElementById("status").textContent =
        urlLocation + "/public/uploads/" + response.filePath;
    } else {
      document.getElementById("status").textContent =
        "Upload failed: " + xhr.statusText;
    }
  };

  xhr.onerror = function () {
    document.getElementById("status").textContent = "Request failed";
  };

  xhr.send(formData);
}

function deleteContent(id, type) {
  var formData = new FormData();

  var xhr = new XMLHttpRequest();
  xhr.open("POST", urlLocation + "/delete_item");

  xhr.onload = function () {
    if (xhr.status == 200) {
      console.log(xhr.responseText);
      window.location.href = urlLocation + "all_post";
    } else {
      console.log("Error Saving: ", xhr.statusText);
    }
  };

  formData.append("id", id);
  formData.append("type", type);

  xhr.send(formData);
}

function saveContent(id, update, type) {
  var content = document.getElementById("content");
  var elements = content.children;
  var formData = new FormData();
  var data = [];

  for (var i = 0; i < elements.length; i++) {
    var element = elements[i];
    var elementType = element.tagName.toLowerCase();
    var elementContent = element.textContent;

    if (elementType == "div") {
      var imgElement = element.getElementsByTagName("img");

      for (var j = 0; j < imgElement.length; j++) {
        var imgSrc = imgElement[j].getAttribute("src");
        var fileName = imgSrc.substring(imgSrc.lastIndexOf("/") + 1);

        data.push({
          type: "img",
          content: fileName,
        });
      }
    } else if (elementType == "ul") {
      var li = element.children;
      var li_array = [];
      for (var j = 0; j < li.length; j++) {
        var text_content = li[j].textContent;
        li_array.push({
          type: "li",
          content: text_content,
        });
      }

      data.push({
        type: "ul",
        content: JSON.stringify(li_array),
      });
    } else {
      data.push({
        type: elementType,
        content: elementContent,
      });
    }
  }

  console.log(data);

  var xhr = new XMLHttpRequest();
  xhr.open("POST", urlLocation + "/save_item");

  xhr.onload = function () {
    if (xhr.status == 200) {
      console.log(xhr.responseText);
      location.reload();
    } else {
      console.log("Error Saving: ", xhr.statusText);
    }
  };

  var json_data = JSON.stringify(data);
  formData.append("json_data", json_data);
  formData.append("transaction", update);
  formData.append("id", id);
  formData.append("type", type);

  xhr.send(formData);
}
