<div class="modal fade" id="popupPost" tabindex="-1" aria-labelledby="popupPost" aria-hidden="true">
    <div class="modal-dialog modal-dialog w-100 w-md-2/5 my-0 h-100 px-1 py-6">
        <div class="modal-content h-100 bg-primary overflow-hidden">
            <div class="modal-body h-100 p-0 rounded-5">
                <article id="post-1" class="post d-flex flex-column
     justify-content-center g-0 post h-100">
                    <div class="post-image h-4/5">
                        <img src=""
                             alt="" class="h-100 w-100">
                    </div>
                    <div class="post-content px-3 py-2 info-block position-relative h-1/5">
                        <button id="description-toggle-1"
                                onclick="toggleDescription('post-1')"
                                class="rounded-circle border-0
                translate-middle-y me-3 position-absolute end-0 top-0 bg-primary h-3 w-3">
                            <i class="fa-solid fa-angle-up text-secondary"></i>
                        </button>

                        <div class="d-flex justify-content-between align-items-center">
                            <h2 class="post-title text-white fs-5 mt-3"></h2>
                            <section class="text-white">
                                <input id="PostID" type="hidden" value="1">
                                <button class="like-button border-0 bg-transparent">
                                    <i class="fa-heart"></i>
                                </button>
                                <button type="button" class="like-list bg-transparent border-0" data-bs-toggle="modal"
                                        data-bs-target="#likeList">
                                    <span class="like-counter text-white">2</span>
                                </button>
                            </section>
                        </div>
                        <p class="text-white description text-truncate">

                        </p>
                        <form class="commentForm">
                            <input type="hidden" value="1" name="post">
                            <div class="input-group">
                                <input type="text" name="comment" placeholder="Aggiungi un commento"
                                       class="form-control border-0 text-white bg-dark py-2 px-3" required/>
                                <button type="submit" class="input-group-text bg-secondary border-0">
                                    <i class="fa-regular fa-paper-plane"></i>
                                </button>
                            </div>
                        </form>
                        <hr class="d-none d-md-block my-3 bg-white"/>
                        <section class="comment-section d-none mt-3 mt-md-0 h-1/2 overflow-auto">
                            <p class="text-white"><span class="comment-counter"></span> Commenti</p>
                            <div class="comments"></div>
                        </section>
                    </div>
                </article>
            </div>
        </div>
    </div>
</div>


<script>
    function toggleDescription(postId) {
        let post = $("#" + postId);

        let image = post.find(".post-image");
        let content = post.find(".post-content");
        let description = content.find(".description");
        let comments = content.find(".comment-section");

        console.log(image,
            content,
            description,
            comments);

        let imageClass = image.hasClass("h-4/5") ? "h-1/5" : "h-4/5";
        let contentClass = content.hasClass("h-4/5") ? "h-1/5" : "h-4/5";
        comments.toggleClass("d-none");

        image.removeClass("h-4/5 h-1/5").addClass(imageClass, 300, "swing");
        content.removeClass("h-4/5 h-1/5").addClass(contentClass, 300, "swing");
        description.toggleClass("text-nowrap");
    }
</script>