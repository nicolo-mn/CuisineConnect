document.addEventListener("DOMContentLoaded", function () {
    $=jQuery;
    $(document).ready(function () {
        $("#followBtn").on("click", function (event) {
            let form = $("#postForm")[0];
            $.ajax({
                type: "POST",
                url: "/follow-unfollow", // Sostituisci con l'URL della tua route
                success: function (response) {
                    // console.log("Risultato: ", response);
                    const newValue = $("#followBtn").val() === "Segui" ? "Smetti di seguire" : "Segui";
                    $("#followBtn").val(newValue);
                },
                error: function (error) {
                    // Gestisci gli errori della richiesta
                    console.error("Errore nella richiesta AJAX: ", error);
                }
            });
        });
    });

});