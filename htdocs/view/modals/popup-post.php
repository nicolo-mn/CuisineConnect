<div class="modal fade" id="popupPost" tabindex="-1" aria-labelledby="popupPost" aria-hidden="true">
    <div class="modal-dialog modal-dialog w-100 w-md-2/5 my-0 h-100 px-1 py-6">
        <div class="modal-content h-100 bg-primary overflow-hidden">
            <div class="modal-body h-100 p-0 rounded-5">
                <article class="post d-flex flex-column
     justify-content-center g-0 h-100">
                    <div class="d-flex flex-column g-0 h-100 overflow-hidden">
                        <div class="post-media d-flex h-4/5 overflow-scroll">
                            <div class="post-image w-100 flex-shrink-0">
                                <img src=""
                                     alt="" class="h-100 w-100">
                            </div>
                            <div class="h-100 w-100 flex-shrink-0">
                                <section class="recipe bg-brick text-secondary d-flex flex-column
     justify-content-center g-0 recipe h-100 overflow-hidden p-3">
                                    <h3 class="font-bold recipe-name"></h3>
                                    <div
                                        class="recipe-nutritional-values d-flex justify-content-between align-items-center">
                                    </div>
                                    <section class="ingredients">
                                        <h4 class="fw-light fs-5">Ingredients:</h4>
                                        <ul class="text-white recipe-ingredients">
                                        </ul>
                                    </section>

                                    <section class="instructions">
                                        <h4 class="fw-light fs-5">Instructions:</h4>
                                        <p class="text-white recipe-instructions">
                                        </p>
                                    </section>
                                </section>
                            </div>
                        </div>
                        <div class="post-content px-3 py-2 info-block position-relative h-1/5">
                            <button id="description-toggle-1"
                                    class="toggle-description rounded-circle border-0
                translate-middle-y me-3 position-absolute end-0 top-0 bg-primary h-3 w-3">
                                <span class="fa-solid fa-angle-up text-secondary"></span>
                            </button>

                            <div class="d-flex justify-content-between align-items-center">
                                <h2 class="post-title text-white fs-5 mt-3"></h2>
                                <div class="text-white">
                                    <input id="PostID" type="hidden" value="">
                                    <button class="like-button border-0 bg-transparent">
                                        <span class="fa-heart"></span>
                                    </button>
                                    <button type="button" class="like-list bg-transparent border-0"
                                            data-bs-toggle="modal"
                                            data-bs-target="#likeList">
                                        <span class="like-counter text-white">2</span>
                                    </button>
                                </div>
                            </div>
                            <p class="text-white description text-truncate">

                            </p>
                            <form class="commentForm">
                                <input type="hidden" value="1" name="post">
                                <div class="input-group">
                                    <label for="comment" hidden>Add a comment</label>
                                    <input type="text" name="comment" id="comment" placeholder="Aggiungi un commento"
                                           class="form-control border-0 text-white bg-dark py-2 px-3" required/>
                                    <button type="submit" class="input-group-text bg-secondary border-0">
                                        <span class="fa-regular fa-paper-plane"></span>
                                    </button>
                                </div>
                            </form>
                            <hr class="d-none d-md-block my-3 bg-white"/>
                            <section class="comment-section d-none mt-3 mt-md-0 h-1/2 overflow-auto">
                                <h3 class="text-white"><span class="comment-counter"></span> Commenti</h3>
                                <div class="comments"></div>
                            </section>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
</div>

<script src="web/js/myrecipes.js"></script>