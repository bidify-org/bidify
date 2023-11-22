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

//next & prev
document.addEventListener("DOMContentLoaded", function () {
    var container = document.getElementById("container");
    var slideLeftButton = document.getElementById("slideleft");
    var slideRightButton = document.getElementById("slideright");

    slideLeftButton.addEventListener("click", function () {
        sideScroll(container, "left", 10, 600, 20);
    });

    slideRightButton.addEventListener("click", function () {
        sideScroll(container, "right", 10, 600, 20);
    });
});

function sideScroll(element, direction, speed, distance, step) {
    var scrollAmount = 0;
    var slideTimer = setInterval(function () {
        if (direction === "left") {
            element.scrollLeft -= step;
        } else {
            element.scrollLeft += step;
        }
        scrollAmount += step;
        if (scrollAmount >= distance) {
            clearInterval(slideTimer);
        }
    }, speed);
}
