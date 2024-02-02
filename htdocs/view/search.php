<div class="d-flex bg-dark justify-content-center align-items-center px-4 py-1 rounded-pill mx-3">
    <i class="fa-solid fa-magnifying-glass fa-2x text-secondary pe-2"></i>
    <input type="text" id="search-input" class="form-control border-0 bg-dark text-white" placeholder="Trova i tuoi amici su CuisineConnect!">
</div>
<div id="searchResults" class="row"></div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    console.log("loaded");
    $(document).ready(function() {
        console.log("ready");
        // Ascolta l'evento di input sulla barra di ricerca
        $("#search-input").on("input", function() {
            console.log("input changed");
            // Ottieni il valore della barra di ricerca
            let searchString = $(this).val();
            // Crea un oggetto FormData e aggiungi il parametro 'searchString'
            let formData = new FormData();
            formData.append("searchString", searchString);
            formData.append("username", "<?php echo $_SESSION["username"]; ?>");

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
                },
                error: function(error) {
                    console.error("Errore nella richiesta AJAX: ", error);
                }
            });
        });
    });
});
</script>