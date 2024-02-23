document.addEventListener("DOMContentLoaded", function () {

    function createComment(commentID, profilePic, commentUser, commentText, isOwner) {
        let update = "";

        if (isOwner) {
            update +=
                `
                <div>
                    <button type="button" class="edit-comment bg-transparent border-0" data-bs-toggle="modal" data-bs-target="#editComment">
                        <i class="fa-solid fa-pen text-secondary"></i>
                    </button>
                    <form class="remove-comment d-inline">
                        <input type="hidden" value="${commentID}" name="comment">
                        <button class="bg-transparent border-0">
                            <i class="fa-solid fa-trash text-secondary"></i>
                        </button>
                    </form>
                </div>
                `;
        }
        return  `<article id="comment-${commentID}" class="d-flex align-items-center mb-2 gap-2">
                    <div class="profile-pic-container overflow-hidden rounded-circle p-0 h-3 w-3">
                        <img
                            src="/${profilePic}"
                            alt="profile picture"
                            class="img-fluid"/>
                    </div>
                    <div class="col">
                        <a class="fs-6 text-white m-00"
                        href="user/user2">@${commentUser}</a>
                        <p class="comment text-white col m-0">
                            ${commentText}</p>
                    </div>
                    ${update}
                </article>
                `
    }

    $(document).ready(function () {
        $("#followBtn").on("click", function (event) {
            let form = $("#postForm")[0];
            let formData = new FormData();
            let username = document.getElementById("username").innerText.replace(/@/g, '');
            ;
            formData.append("username", username);
            $.ajax({
                type: "POST",
                url: "/follow-unfollow", 
                data: formData,
                processData: false,  
                contentType: false,  
                success: function (response) {
                    let newValue;
                    let followers = parseInt(document.getElementById("followers").innerHTML);
                    if (document.getElementById("followBtn").value === "Follow") {
                        newValue = "Unfollow";
                        followers++;
                    } else {
                        newValue = "Follow";
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
                let username = document.getElementById("username").innerText.replace(/@/g, '');
                ;
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
                            result +=
                            `
                            <div class="col g-0">
                                <button class="show-post border-0 ratio ratio-1x1" data-bs-toggle="modal" data-bs-target="#popupPost">
                                    <img src="/${post["Foto"]}" alt="post photo" class="img-fluid"/>
                                </button>
                                <input type="hidden" value="${post["PostID"]}"/>
                            </div>
                            `;
                        });
                        $("#post-tab").html(result);
                        showPost();
                    },
                    error: function (error) {
                        console.error("Errore nella richiesta AJAX: ", error);
                    }
                });
            }
        }

        function showPost() {
            $(".show-post").on("click", function () {
                let postID = $(this).siblings("input").first();
                let formData = new FormData();
                formData.append("PostID", postID.val());
                $.ajax({
                    type: "POST",
                    url: "/get-post",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        let post = JSON.parse(response);
                        let $modal = $("#popupPost");
                        if (post["RecipeID"]) {
                            fetchRecipeData($modal, post["RecipeID"]);
                            $modal.find('.post-receipe').show();
                        } else {
                            $modal.find('.post-receipe').hide();
                        }                    
                        $modal.find(".post-image img").attr("src", "/"+post["Foto"]);
                        $modal.find(".post-title").text(post["Titolo"]);
                        $modal.find(".description").text(post["Descrizione"]);
                        $modal.find(".description").text(post["Descrizione"]);
                        $modal.find("#PostID").val(post["PostID"]);
                        $modal.find(".commentForm input[name^=\"post\"]").val(post["PostID"]);
                        $modal.find("button.like-list").on("click", function () {
                            loadLikeList(post["PostID"]);
                        })
                        if (post["isLike"]) {
                            $modal.find(".fa-heart").removeClass("fa-regular text-white");
                            $modal.find(".fa-heart").addClass("fa text-danger");
                            $modal.find(".like-button").addClass("liked");
                        } else {
                            $modal.find(".fa-heart").addClass("fa-regular text-white");
                            $modal.find(".fa-heart").removeClass("fa text-danger liked");
                            $modal.find(".like-button").removeClass("liked");
                        }
    
                        let comments = ""
    
                        $(post["Commenti"]).each(function () {
                            comments += createComment(
                                this["NotificationID"],
                                this["ImmagineProfilo"],
                                this["Username"],
                                this["Testo"],
                                this["owner"]
                            )
                        })
    
                        $modal.find(".comment-section .comments").html(comments);
                        $modal.find(".comment-counter").text(post["Commenti"].length);
                        $modal.find(".like-counter").text(post["NumeroLike"]);
    
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
    
                        $(".remove-comment").submit(function (e) {
                            e.preventDefault();
    
                            let commentID = $(this).find("input").val();
                            let comment = $("#comment-" + commentID);
    
                            handleCommentAjax("/remove-comment", $(this).serialize(), function () {
                                comment.remove();
                            });
                        });
    
                    },
                    error: function (error) {
                        console.error("Errore nella richiesta AJAX: ", error);
                    }
                });
            })
        }

        $("#mentioned").on("click", function (event) {
            event.preventDefault();
            loadPosts("mentioned");
        });

        $("#posted").on("click", function (event) {
            event.preventDefault();
            loadPosts("posted");
        });

        showPost();
    });

});

function fetchRecipeData(modal, recipeID) {
    $.ajax({
        type: "POST",
        url: "/get-recipe",
        data: {RecipeID: recipeID},
        success: function (response) {

            let recipe = JSON.parse(response);

            $(modal).find(".recipe-name").text(recipe["Nome"]);
            let nutritionalValues = JSON.parse(recipe["ValoriNutrizionali"]);
            let nutritionalValuesText = "";
            for (const key in nutritionalValues) {
                const [quantity, unit] = nutritionalValues[key];
                nutritionalValuesText +=
                    `
                    <div class="text-center text-white">
                        <p class="mb-0">${Math.floor(quantity)} ${unit}</p>
                        <p>${key}</p>
                    </div>
                    `;
            }
            $(modal).find(".recipe-nutritional-values").html(nutritionalValuesText);
            let ingredientsText = "";
            const ingredientsList = JSON.parse(recipe["Ingredienti"]);
            ingredientsList.forEach(ingredient => {
                ingredientsText += `<li>${ingredient}</li>`;
            })
            $(modal).find(".recipe-ingredients").html(ingredientsText);
            $(modal).find(".recipe-instructions").text(recipe["Procedimento"]);
        },
        error: function (error) {
            console.error("Errore nella richiesta AJAX: ", error);
        }
    });
}

function loadLikeList(postID) {
    let formData = new FormData();
    formData.append("post", postID)
    $.ajax({
        type: "POST",
        url: "/like-list",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            let users = JSON.parse(response);
            $("#likeList .modal-body").html("");
            let html = "";
            $(users).each(function (){
                html += 
                    `
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="profile-pic-container overflow-hidden rounded-circle p-0 h-3 w-3">
                            <img src="/${this["ImmagineProfilo"]}" alt="profile-image"
                                class="img-fluid"/>
                        </div>
                        <a class="fs-6 text-primary m-00"
                        href="user/${this["Username"]}">@${this["Username"]}</a>
                    </div>
                    `;
                
                $("#likeList .modal-body").html(html);
            })
        },
        error: function (error) {
            console.error("Errore nella richiesta AJAX: ", error);
        }
    });
}
