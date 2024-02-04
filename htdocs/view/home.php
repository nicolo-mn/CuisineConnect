<?php
$posts = PostController::getInstance()->getPosts();
?>

<!--<button class="btn btn-secondary rounded-pill">ADD</button>

<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Launch demo modal
</button>-->
<section class="h-100 overflow-scroll" id="feed">
    <?php
    foreach ($posts as $post) {
        require "post.php";
    }
    ?>
</section>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php if (isset($_SESSION["user_id"])): ?>
                <form id="postForm" action="/submit-post" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="title">Titolo:</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                        <small id="titleHelp" class="form-text text-muted">Il titolo deve essere lungo almeno 5 caratteri.</small>
                    </div>

                    <div class="form-group">
                        <label for="description">Descrizione:</label>
                        <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="file">Aggiungi un file:</label>
                        <input type="file" class="form-control-file" id="file" name="file">
                    </div>
                </form>
                <?php endif; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="post" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        $(document).ready(function () {
            // Ascolta l'evento di sottoposizione del form


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
                            console.log(response);
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
            $("#titleHelp").text("Il titolo deve essere lungo almeno 5 caratteri.");

            // Validazione del titolo
            if (title.length < 5) {
                // Se il titolo è troppo corto, mostra un messaggio di errore
                $("#titleHelp").text("Il titolo deve essere lungo almeno 5 caratteri.");
                return false;
            }

            // Form valido
            return true;
        }
    });

</script>

<script>
    function toggleDescription(postId) {
        let post = $("#"+postId)[0];
        console.log(post);
        let image = $(post).find(".post-image")[0];
        let content = $(post).find(".post-content")[0];
        let description =$(content).find(".description")[0];

        if($(image).hasClass("h-4/5")) {
            $(image).removeClass("h-4/5");
            $(content).removeClass("h-1/5");

            $(image).addClass("h-1/5", 300, "swing");
            $(content).addClass("h-4/5", 300, "swing");
            $(description).removeClass("text-nowrap");
        } else {
            $(image).removeClass("h-1/5");
            $(content).removeClass("h-4/5");

            $(image).addClass("h-4/5");
            $(content).addClass("h-1/5");
            $(description).addClass("text-nowrap");
        }
    }
    document.addEventListener("DOMContentLoaded", function (){

    });
</script>