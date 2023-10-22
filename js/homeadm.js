document.getElementById("openModal").addEventListener("click", function () {
    document.getElementById("productModal").style.display = "block";
});

document.getElementById("closeModal").addEventListener("click", function () {
    document.getElementById("productModal").style.display = "none";
});

window.addEventListener("click", function (event) {
    var modal = document.getElementById("productModal");
    if (event.target == modal) {
        modal.style.display = "none";
    }
});

