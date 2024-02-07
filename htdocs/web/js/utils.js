document.addEventListener("DOMContentLoaded", function () {
    $(".post").each(function () {
        let toggleDescriptionButton = $(this).find(".toggle-description")
        let post = $(this)
        toggleDescriptionButton.on("click", function () {
            toggleDescription(post)
            $(this).children("span").toggleClass("fa-angle-up fa-angle-down");
        });
    })
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