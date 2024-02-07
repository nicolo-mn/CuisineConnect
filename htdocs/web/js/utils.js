document.addEventListener("DOMContentLoaded", function () {
    $(".post").each(function () {
        let toggleDescriptionButton = $(this).find(".toggle-description")
        let post = $(this)
        toggleDescriptionButton.on("click", function () {
            toggleDescription(post)
            $(this).children("span").toggleClass("fa-angle-up fa-angle-down");
        });
    })


    var sidebar = document.querySelector('nav > ul');
    sidebar.style.right = '-250px';
    var menuBtn = document.querySelector('.menu-btn');

    // Funzione per aprire/chiudere il menu
    function toggleMenu() {
        console.log("clicked")
        $(sidebar).toggleClass("d-none", 0, "easeOutSine", function () {
            console.log("dfsfd");
            if (sidebar.style.right === '0px') {
                sidebar.style.right = '-250px';
            } else {
                sidebar.style.right = '0px';
            }
        });

    }

    // Event listener per il pulsante del menu
    menuBtn.addEventListener('click', toggleMenu);

    // Event listener per il clic al di fuori del menu per chiuderlo
    document.addEventListener('click', function (event) {
        var target = event.target;
        if (target !== menuBtn && !sidebar.contains(target)) {
            sidebar.style.right = '-250px';
            $(sidebar).addClass("d-none");
        }
    });
});

function toggleDescription(postElement) {
    let post = postElement;
    let image = post.find(".post-media");
    let content = post.find(".post-content");
    let description = content.find(".description");
    let comments = content.find(".comment-section")

    let imageClass = image.hasClass("h-4/5") ? "h-1/5" : "h-4/5";
    let contentClass = content.hasClass("h-4/5") ? "h-1/5" : "h-4/5";
    comments.toggleClass("d-none");

    image.removeClass("h-4/5 h-1/5").addClass(imageClass);
    content.removeClass("h-4/5 h-1/5").addClass(contentClass);
    description.toggleClass("text-nowrap");
}