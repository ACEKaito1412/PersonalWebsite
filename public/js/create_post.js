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
