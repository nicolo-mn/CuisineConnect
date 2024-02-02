document.addEventListener("DOMContentLoaded", function () {
    $=jQuery;
    $(document).ready(function () {
        $("#followBtn").on("click", function (event) {
            let form = $("#postForm")[0];
            let formData = new FormData();
            let username = document.getElementById("username").innerText.replace(/@/g, '');;
            formData.append("UserID", username);
            $.ajax({
                type: "POST",
                url: "/follow-unfollow", // Sostituisci con l'URL della tua route
                data: formData,
                processData: false,  // Non processare i dati (FormData si occupa di questo)
                contentType: false,  // Non impostare l'intestazione Content-Type (FormData si occupa di questo)
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