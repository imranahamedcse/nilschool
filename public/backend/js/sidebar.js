let btn = document.querySelector("#btn-menu-bar");
let sidebar = document.querySelector(".sidebar");

btn.addEventListener("click", () => {
    if (window.innerWidth > 768) {
        sidebar.classList.toggle("close");
    } else {
        toggleSidebar();
    }
});

let arrows = document.querySelectorAll(".icon-link");
for (var i = 0; i < arrows.length; i++) {
    arrows[i].addEventListener("click", (e) => {
        let arrowParent = e.target.parentElement;

        arrowParent.classList.toggle("show");
    });
}


function toggleSidebar() {
    document.querySelector('.sidebar').classList.toggle('show');
}
