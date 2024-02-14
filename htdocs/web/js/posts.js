document.addEventListener("DOMContentLoaded", function () {
    $(document).ready(function () {

        $("#post").on("click", function (event) {
            // Esegui la validazione
            if (validateForm()) {
                let form = $("#postForm")[0];
                let formData = new FormData(form);
                // Se la validazione non passa, annulla la sottoposizione del form
                $.ajax({
                    type: "POST",
                    url: "/submit-post", // Sostituisci con l'URL della tua route
                    data: formData,
                    processData: false,  // Non processare i dati (FormData si occupa di questo)
                    contentType: false,  // Non impostare l'intestazione Content-Type (FormData si occupa di questo)
                    success: function (response) {
                        $("#addPost").modal('hide')
                    },
                    error: function (error) {
                        // Gestisci gli errori della richiesta
                        console.error("Errore nella richiesta AJAX: ", error);
                    }
                });
            }
        });
    });

    function validateForm() {
        // Ottieni il valore del titolo
        var title = $("#title").val();

        // Resetta il messaggio di aiuto
        $("#titleHelp").text("Title must be at least 5 characters longy.");
        var file = $("#file")[0].files[0];
        // Validazione del titolo
        if (title.length < 5) {
            // Se il titolo è troppo corto, mostra un messaggio di errore
            $("#titleHelp").text("Title must be at least 5 characters longy.");
            return false;
        }

        if (!file) {
            $("#fileHelp").text("File must be uploaded");
            return false;
        }

        // Form valido
        return true;
    }
});
