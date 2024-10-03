document.querySelector('.custom-file-input').addEventListener('change', function (e) {
    var fileName = e.target.files[0].name;
    var label = e.target.nextElementSibling;
    label.textContent = fileName;
  });

  document.getElementById('addAuthorBtn').addEventListener('click', function() {
    var addAuthorForm = document.getElementById('addAuthorForm');
    if (addAuthorForm.style.display === "none") {
        addAuthorForm.style.display = "block";
        setTimeout(function() {
            addAuthorForm.style.opacity = "1";
        }, 10);
    } else {
        addAuthorForm.style.opacity = "0";
        setTimeout(function() {
            addAuthorForm.style.display = "none";
        }, 500);
    }
});

document.getElementById('addCategoryBtn').addEventListener('click', function() {
    var addAuthorForm = document.getElementById('addCategoryForm');
    if (addAuthorForm.style.display === "none") {
        addAuthorForm.style.display = "block";
        setTimeout(function() {
            addAuthorForm.style.opacity = "1";
        }, 10);
    } else {
        addAuthorForm.style.opacity = "0";
        setTimeout(function() {
            addAuthorForm.style.display = "none";
        }, 500);
    }
});
