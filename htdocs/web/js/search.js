document.addEventListener("DOMContentLoaded", function() {
    $(document).ready(function() {
        $("#search-input").on("input", function() {
            let searchString = $(this).val();
            if (searchString === "") {
                document.getElementById("searchResults").innerHTML = "";
                return;
            }
            let formData = new FormData();
            formData.append("searchString", searchString);

            $.ajax({
                type: "POST",
                url: "/search-user",  
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    const users = JSON.parse(response);
                    let result = "";
                    users.forEach(user => {
                        result += 
                        `
                        <a href="/user/${user["Username"]}" class="text-decoration-none">
                            <div class="row user-searched mx-0">
                                <div class="d-flex justify-content-start py-3 align-items-center">
                                    <div class="col-1 me-3">
                                        <div class="ratio ratio-1x1">
                                            <img src="${user["ImmagineProfilo"]}" alt="profile picture" class="img-fluid rounded-circle"/>
                                        </div>
                                    </div>
                                    <p class="text-white m-0 data-username">@${user["Username"]}</p>
                                </div>
                            </div>
                        </a>
                        `;
                    });
                    document.getElementById("searchResults").innerHTML = result;
                },
                error: function(error) {
                    console.error("Errore nella richiesta AJAX: ", error);
                }
            });
        });
    });
});