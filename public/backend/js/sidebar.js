let btn = document.querySelector("#btn-menu-bar");
let sidebar = document.querySelector(".sidebar");

btn.addEventListener("click", () => {
    if (window.innerWidth > 768) {
        sidebar.classList.toggle("close");
    } else {
        toggleSidebar();
    }
});

// let arrows = document.querySelectorAll(".icon-link");
// for (var i = 0; i < arrows.length; i++) {
//     arrows[i].addEventListener("click", (e) => {
//         let arrowParent = e.target.parentElement;

//         arrowParent.classList.toggle("show");
//     });
// }
document.addEventListener('DOMContentLoaded', function() {
    function removeAllShowClasses() {
        var liElements = document.querySelectorAll('li.show');
        liElements.forEach(function(li) {
            li.classList.remove('show');
        });
    }

    var iconLinks = document.querySelectorAll('.icon-link');
    iconLinks.forEach(function(iconLink) {
        iconLink.addEventListener('click', function(event) {
            removeAllShowClasses();
            toggleParentClass(event.currentTarget);
        });
    });
});

function toggleParentClass(element) {
    var parentItem = element.closest('li');
    parentItem.classList.toggle('show');
}

function toggleSidebar() {
    document.querySelector('.sidebar').classList.toggle('show');
}
