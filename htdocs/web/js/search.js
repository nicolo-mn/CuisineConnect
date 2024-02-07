document.addEventListener("DOMContentLoaded", function() {
    $(document).ready(function() {
        // Ascolta l'evento di input sulla barra di ricerca
        $("#search-input").on("input", function() {
            let searchString = $(this).val();
            let formData = new FormData();
            formData.append("searchString", searchString);

            $.ajax({
                type: "POST",
                url: "/search-user",  // Sostituisci con l'URL della tua route
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log(response);
                    const users = JSON.parse(response);
                    let result = "";
                    users.forEach(user => {
                        result += 
                        `
                        <a href="/user/${user["Username"]}" class="text-decoration-none">
                            <div class="row user-searched mx-0">
                                <section class="d-flex justify-content-start py-3 align-items-center">
                                    <div class="col-1 me-3">
                                        <div class="ratio ratio-1x1">
                                            <img src="${user["ImmagineProfilo"]}" alt="profile picture" class="img-fluid rounded-circle">
                                        </div>
                                    </div>
                                    <p class="text-white m-0 data-username">@${user["Username"]}</p>
                                </section>
                            </div>
                        </a>
                        `;
                    });
                    document.getElementById("searchResults").innerHTML = result;
                    console.log("Risultato: ", response);
                },
                error: function(error) {
                    console.error("Errore nella richiesta AJAX: ", error);
                }
            });
        });
    });
});