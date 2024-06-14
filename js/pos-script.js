document.addEventListener("DOMContentLoaded", function () {
  // Add new row
  addRowButton.addEventListener("click", function () {
    addNewRow();
  });

  // Remove row
  formRows.addEventListener("click", function (e) {
    if (e.target && e.target.classList.contains("remove-row")) {
      e.target.closest(".form-row").remove();
      ShowTotal();
    }
  });

  // Hold form data
  holdFormButton.addEventListener("click", function () {
    if (validateForm()) {
      const holdKey = prompt("Enter a description for this hold:");
      if (holdKey) {
        const exists = holdFormData(holdKey);
        if (exists === true) {
          alert("ERROR: Please set a different name");
        }
      }
    }
  });

  // Show hold list
  showHoldListButton.addEventListener("click", function () {
    showHoldList();
    $("#holdListModal").modal("show");
  });

  // Form submission
  form.addEventListener("submit", function (e) {
    e.preventDefault();
    if (validateForm()) {
      memoList = [];
      const formData = getFormData();
      ShowTotal();
      console.log(formData);
      formData.map((item) => {
        SellItem({
          common_article: item.article,
          common_price: item.price,
          salesman: document.getElementById("salesman").value || "",
        });
      });
      // print now
      console.log(memoList);
      InitForm();
    }

    // Perform your desired action with the data, such as sending it to a server
  });

  // Load form data for editing
  holdList.addEventListener("click", function (e) {
    if (e.target && e.target.classList.contains("edit-hold")) {
      const key = e.target.getAttribute("data-key");
      if (confirm("You you sure to edit?")) {
        loadFormData(key);
        $("#holdListModal").modal("hide");
        deleteFromHoldList(key);
        ShowTotal();
      }
    }
  });
});

const form = document.getElementById("dynamic-form");
const formRows = document.getElementById("form-rows");
const addRowButton = document.getElementById("add-row");
const holdFormButton = document.getElementById("hold-form");
const switchFormButton = document.getElementById("switch-form");
const showHoldListButton = document.getElementById("show-hold-list");
const holdListModal = document.getElementById("holdListModal");
const holdList = document.getElementById("hold-list");
const anotherForm = document.getElementById("another-form");
const backToPosButton = document.getElementById("back-to-pos");

// window.price_list = {
//   Edge: 200,
//   Firefox: 100,
//   Chrome: 150,
//   Opera: 70,
//   Safari: 60,
// };

function setRowPrice(obj) {
  var art = obj.value;
  var price = GetArticlePrice(art);

  obj.closest(".form-row").querySelector("input[name='price[]']").value = price;
}

function InitForm(article = "", price = "") {
  const newRow = `
      <div class="form-row align-items-center mb-2">
              <div class="col">
                  <input type="text" onBlur="setRowPrice(this)" list="articles" class="form-control" name="article[]" required placeholder="Article" value="">
              </div>
              <div class="col">
                  <input type="number"  onblur="ShowTotal(this)" class="form-control" name="price[]" required placeholder="Price" value="">
              </div>
              <div class="col-auto">
                  <button type="button" class="btn btn-danger remove-row">-</button>
              </div>
      </div>
      `;
  formRows.innerHTML = newRow;
  document.getElementById("totalItemPrice").value = 0;
}

// Add new row function
function addNewRow(article = "", price = "") {
  const newRow = document.createElement("div");
  newRow.className = "form-row align-items-center mb-2";
  newRow.innerHTML = `
          <div class="col">
              <input type="text" onBlur="setRowPrice(this)" list="articles" class="form-control" name="article[]" required placeholder="Article" value="${article}">
          </div>
          <div class="col">
              <input type="number"  onblur="ShowTotal(this)" class="form-control" name="price[]" required placeholder="Price" value="${price}">
          </div>
          <div class="col-auto">
              <button type="button" class="btn btn-danger remove-row">-</button>
          </div>
      `;
  formRows.appendChild(newRow);
}

// Hold form data function
function holdFormData(holdKey) {
  const formData = getFormData();
  const existingHolds = JSON.parse(localStorage.getItem("posFormData")) || {};
  if (existingHolds[holdKey]) {
    return true;
  }
  if (formData.length === 0) return false;
  existingHolds[holdKey] = formData;
  localStorage.setItem("posFormData", JSON.stringify(existingHolds));
  //  alert("Form data has been held.");
  InitForm();
}

function validateForm() {
  const formData = new FormData(form);
  const articles = formData.getAll("article[]");
  const prices = formData.getAll("price[]");

  for (let i = 0; i < articles.length; i++) {
    if (!articles[i].trim() || !prices[i].trim()) {
      alert("ERROR: All fields must be filled out.");
      return false;
    }
  }
  return true;
}

// Get form data function
function getFormData() {
  let formdataItems = [];
  const formData = new FormData(form);

  const articles = formData.getAll("article[]").filter((article) => article.trim() !== "");
  const prices = formData.getAll("price[]");

  if (articles.length) {
    formdataItems = articles.map((article, index) => ({
      article: article,
      price: prices[index] || 0,
    }));
  }
  return formdataItems;
}

// Show hold list function
function showHoldList() {
  holdList.innerHTML = "";
  const existingHolds = JSON.parse(localStorage.getItem("posFormData")) || {};
  for (const key in existingHolds) {
    const listItem = document.createElement("li");
    listItem.className = "list-group-item d-flex justify-content-between align-items-center";
    listItem.innerHTML = `
              ${key}
              <button class="btn btn-primary btn-sm edit-hold" data-key="${key}">Edit</button>
          `;
    holdList.appendChild(listItem);
  }
}

// Load form data function
function loadFormData(key) {
  const existingHolds = JSON.parse(localStorage.getItem("posFormData")) || {};
  if (existingHolds[key]) {
    formRows.innerHTML = ""; // Clear existing rows
    existingHolds[key].forEach((data) => addNewRow(data.article, data.price));
  }
}

// Load form data function
function deleteFromHoldList(key) {
  const existingHolds = JSON.parse(localStorage.getItem("posFormData")) || {};
  if (existingHolds[key]) {
    delete existingHolds[key]; // Clear existing rows
  }
  localStorage.setItem("posFormData", JSON.stringify(existingHolds));
}

function GetArticlePrice(art) {
  if (art != "" && art != "undefined" && window.price_list[art] != "undefined" && window.price_list[art] > 1) {
    return window.price_list[art];
  }
  return "";
}

function ShowTotal(obj) {
  const formData = getFormData();
  console.log(formData);
  const total = formData.reduce((a, b) => {
    return a + Number(b.price);
  }, 0);
  document.getElementById("totalItemPrice").value = total;

  console.log(total);
}
