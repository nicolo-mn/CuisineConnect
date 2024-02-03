document.addEventListener("DOMContentLoaded", function () {
    $(document).ready(function () {
        $("#followBtn").on("click", function (event) {
            let form = $("#postForm")[0];
            let formData = new FormData();
            let username = document.getElementById("username").innerText.replace(/@/g, '');;
            formData.append("username", username);
            $.ajax({
                type: "POST",
                url: "/follow-unfollow", // Sostituisci con l'URL della tua route
                data: formData,
                processData: false,  // Non processare i dati (FormData si occupa di questo)
                contentType: false,  // Non impostare l'intestazione Content-Type (FormData si occupa di questo)
                success: function (response) {
                    let newValue;
                    let followers = parseInt(document.getElementById("followers").innerHTML);
                    if (document.getElementById("followBtn").value === "Segui") {
                        newValue = "Smetti di seguire";
                        followers++;
                    } else {
                        newValue = "Segui";
                        followers--;
                    }
                    document.getElementById("followers").innerHTML = followers;
                    document.getElementById("followBtn").value = newValue;
                },
                error: function (error) {
                    console.error("Errore nella richiesta AJAX: ", error);
                }
            });
        });

        const loadPosts = (clickedTab) => {
            if (!$("#" + clickedTab).hasClass('border-bottom')) {
                $(".border-bottom").removeClass('border-bottom');
                $("#" + clickedTab).addClass('border-bottom');
                let formData = new FormData();
                let username = document.getElementById("username").innerText.replace(/@/g, '');;
                formData.append("username", username);
                $.ajax({
                    type: "POST",
                    url: "/" + clickedTab + "-posts", 
                    data: formData,
                    processData: false, 
                    contentType: false,  
                    success: function (response) {
                        const posts = JSON.parse(response);
                        let result = "";
                        posts.forEach(post => {
                            result += `
                            <div class="col g-0">
                                <img src="${post["Foto"]}" alt="food" class="img-fluid">
                            </div>
                            `;
                        });
                        $("#post-tab").html(result);
                    },
                    error: function (error) {
                        console.error("Errore nella richiesta AJAX: ", error);
                    }
                });
            }
        }

        $("#mentioned").on("click", function (event) {
            event.preventDefault();
            loadPosts("mentioned");
        });

        $("#posted").on("click", function (event) { 
            event.preventDefault();
            loadPosts("posted");
        });
    });

});