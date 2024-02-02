document.addEventListener("DOMContentLoaded", function() {
    $(document).ready(function() {
        // Ascolta l'evento di input sulla barra di ricerca
        $("#search-input").on("input", function() {
            // Ottieni il valore della barra di ricerca
            let searchString = $(this).val();
            // Crea un oggetto FormData e aggiungi il parametro 'searchString'
            let formData = new FormData();
            formData.append("searchString", searchString);

            // Esegui la richiesta AJAX
            $.ajax({
                type: "POST",
                url: "/search-user",  // Sostituisci con l'URL della tua route
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // Aggiorna la parte della pagina in cui vuoi mostrare i risultati
                    document.getElementById("searchResults").innerHTML = response;

                    var searchUsers = document.querySelectorAll('.user-searched');

                    searchUsers.forEach(function(user) {
                        user.addEventListener('click', function() {
                            var username = this.querySelector('.data-username').innerHTML.replace(/@/g, '');
                            window.location.href = "/user/" + username;
                        });
                    });
                },
                error: function(error) {
                    console.error("Errore nella richiesta AJAX: ", error);
                }
            });
        });
    });
});