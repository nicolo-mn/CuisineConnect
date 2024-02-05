$(document).ready(function () {
    // Funzione comune per gestire le richieste AJAX dei commenti
    function handleCommentAjax(url, data, successCallback) {
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            success: function (response) {
                successCallback(response);
            },
            error: function (error) {
                console.error("Errore nella richiesta AJAX: ", error);
            }
        });
    }

    // Gestione dell'invio del commento
    $(".commentForm").submit(function (e) {
        e.preventDefault();

        let commentText = $(this).find('input[name^="comment"]').first().val();

        if (commentText.trim() === "") {
            alert("Il commento non può essere vuoto.");
            return;
        }

        handleCommentAjax("/add-comment", $(this).serialize(), function () {
            window.location.reload();
        });
    });

    // Gestione della rimozione del commento
    $(".remove-comment").submit(function (e) {
        e.preventDefault();

        let commentID = $(this).find("input").val();
        let comment = $("#comment-" + commentID);

        handleCommentAjax("/remove-comment", $(this).serialize(), function () {
            comment.remove();
        });
    });

    // Gestione della modifica del commento
    $(".comment-section").on("click", ".edit-comment", function () {
        let editButton = $(this);
        let comment = editButton.closest("article").find(".comment").first();
        let commentID = parseInt(editButton.closest("article").attr("id").replace("comment-", ""));

        $("#editComment #commentText").val(comment.text().trim());
        $("#editComment #commentID").val(commentID);
    });

    // Gestione dell'aggiornamento del commento
    $("#editComment form").on("submit", function (e) {
        e.preventDefault();
        let commentID = $("#commentID").val();
        let commentText = $("#commentText").val();

        handleCommentAjax("/update-comment", $(this).serialize(), function () {
            $("#editComment").modal("toggle");
            $("#comment-" + commentID).find(".comment").text(commentText);
        });
    });
});
