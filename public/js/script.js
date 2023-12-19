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
    const container = document.getElementById("container");
    const slideLeftButton = document.getElementById("slideleft");
    const slideRightButton = document.getElementById("slideright");

    slideLeftButton.addEventListener("click", function () {
        sideScroll(container, "left", 10, 600, 1000);
    });

    slideRightButton.addEventListener("click", function () {
        sideScroll(container, "right", 10, 600, 1000);
    });
});

function sideScroll(element, direction, speed, distance, step) {
    let scrollAmount = 0;
    const slideTimer = setInterval(function () {
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
