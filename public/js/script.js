function toggleNav() {
    let isOpen = false;
    const toggleButton = document.getElementById("toggleButton");
    const container = document.getElementById("containerNav");

    function closeContainer() {
        isOpen = false;
        container.style.display = "none";
    }

    toggleButton.addEventListener("click", function (event) {
        event.stopPropagation(); // Prevents the click event from reaching the document
        isOpen = !isOpen;
        container.style.display = isOpen ? "block" : "none";
    });

    document.addEventListener("click", function () {
        closeContainer();
    });

    container.addEventListener("click", function (event) {
        event.stopPropagation(); // Prevents the click event from reaching the document
    });
}

document.addEventListener("DOMContentLoaded", toggleNav);
