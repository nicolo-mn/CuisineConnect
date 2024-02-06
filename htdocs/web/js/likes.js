document.addEventListener("DOMContentLoaded", function () {
    $(document).on("click", ".like-button", function () {
        let $button = $(this);
        let heart = $button.children(".fa-heart").first();
        let counter = $button.siblings("button").first().children().first();
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

    $(document).ready(function () {
        $(".post").each(function () {
            let postID = parseInt(this.id.replace("post-",""));
            $(this).find(".like-list").on("click", function () {
                let formData = new FormData();
                formData.append("post", postID)
                $.ajax({
                    type: "POST",
                    url: "/like-list",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        let users = JSON.parse(response);
                        $("#likeList .modal-body").html("");
                        let html = "";
                        $(users).each(function (){
                            html += '<div class="d-flex justify-content-between align-items-center mb-2">\n' +
                                '    <div class="profile-pic-container overflow-hidden rounded-circle p-0 h-3 w-3">\n' +
                                '        <img src="'+this["ImmagineProfilo"]+'" alt=""\n' +
                                '             class="img-fluid">\n' +
                                '    </div>\n' +
                                '    <a class="fs-6 text-primary m-00"\n' +
                                '       href="user/'+this["Username"]+'">@'+this["Username"]+'</a>\n' +
                                '</div>'
                            $("#likeList .modal-body").html(html);
                        })
                    },
                    error: function (error) {
                        console.error("Errore nella richiesta AJAX: ", error);
                    }
                });
            })
        })
    })
});