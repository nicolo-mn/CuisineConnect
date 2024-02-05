document.addEventListener("DOMContentLoaded", function () {
    $(document).on("click", ".like-button", function () {
        let $button = $(this);
        let heart = $button.children().first();
        let counter = $button.siblings("span").first();
        let data = new FormData();
        let input = $button.siblings("input").first();
        data.append("post", input.val());

        $.ajax({
            type: "POST",
            url: $button.hasClass("liked") ? "/remove-like" : "/like-post",
            data: data,
            processData: false,
            contentType: false,
            success: function (response) {
                heart.toggleClass("fa fa-regular text-danger text-white");
                counter.text(parseInt(counter.text()) + ($button.hasClass("liked") ? -1 : 1));
                $button.toggleClass("liked");
            },
            error: function (error) {
                console.error("Errore nella richiesta AJAX: ", error);
            }
        });
    });
});