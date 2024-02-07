<?php if (isset($post)): ?>
    <article id="post-<?= $post["PostID"] ?>"
             class="post d-flex flex-column flex-md-row g-0 h-100 overflow-hidden">
        <div class="post-media d-flex col-md-6 h-4/5 h-md-100">
            <div class="post-image w-100">
                <img src="<?= $post["Foto"] ?>" alt="post picture" class="h-100 w-100" />
            </div>
            <?php if (isset($post["Ricetta"])): ?>
                <div class="h-100 w-100">
                    <?php
                    $recipe = $post["Ricetta"];
                    require "recipe.php"

                    ?>
                </div>
            <?php endif ?>
        </div>
        <header class="post-content col-md-6 px-3 py-2 info-block h-1/5 h-md-auto">
            <button id="description-toggle-<?= $post["PostID"] ?>"
                    class="toggle-description d-md-none rounded-circle border-0
                translate-middle-y me-3 position-absolute end-0 top-0 bg-primary h-3 w-3">
                <span class="fa-solid fa-angle-up text-secondary"></span>
            </button>
            <div class="align-items-center abs-section d-flex gap-3">
                <div
                    class="h-5 w-5 rounded-circle p-1 bg-white d-flex justify-content-center align-items-center">
                    <div class="profile-pic-container overflow-hidden rounded-circle p-0">
                        <img
                            src="<?= $post["ImmagineProfilo"] ?>" alt="profile picture"
                            class="img-fluid" />
                    </div>
                </div>
                <a class="d-none d-md-block text-white col m-0" href="user/<?= $post["Username"] ?>">
                    @<?= $post["Username"] ?>
                </a>
            </div>

            <div class="d-flex justify-content-between align-items-center">
                <h2 class="text-white fs-5 mt-3"><?= $post["Titolo"] ?></h2>
                <div class="text-white">
                    <input type="hidden" value="<?= $post["PostID"] ?>" />
                    <button class="like-button <?= $post["isLike"] ? "liked" : "" ?> border-0 bg-transparent">
                        <?php if ($post["isLike"]): ?>
                            <span class="fa fa-heart text-danger"></span>
                        <?php else: ?>
                            <span class="fa-regular fa-heart text-white"></span>
                        <?php endif; ?>
                    </button>
                    <button type="button" class="like-list like counter bg-transparent border-0" data-bs-toggle="modal"
                            data-bs-target="#likeList">
                        <span class="text-white"><?= $post["NumeroLike"] ?></span>
                    </button>
                </div>
            </div>
            <p class="text-white description text-nowrap text-md-wrap">
                <?= $post["Descrizione"] ?>
            </p>
            <form class="commentForm">
                <input type="hidden" value="<?= $post["PostID"] ?>" name="post" />
                <div class="input-group">
                    <label for="addComment-<?= $post["PostID"] ?>" hidden>Add a comment</label>
                    <input type="text" name="comment" id="addComment-<?= $post["PostID"] ?>"
                           placeholder="Add a comment"
                           class="form-control border-0 text-white bg-dark py-2 px-3" required/>
                    <button type="submit" class="input-group-text bg-secondary border-0">
                        <span class="fa-regular fa-paper-plane"></span>
                    </button>
                </div>
            </form>
            <hr class="d-none d-md-block my-3 bg-white"/>
            <section class="comment-section d-none mt-3 mt-md-0 d-md-block h-1/2 overflow-auto">
                <h3 class="fs-5 text-white"><?= count($post["Commenti"]) ?> Comments </h3>
                <?php foreach ($post["Commenti"] as $commento): ?>
                    <article id="comment-<?= $commento["NotificationID"] ?>"
                             class="d-flex align-items-center mb-2 gap-2">
                        <div class="profile-pic-container overflow-hidden rounded-circle p-0 h-3 w-3">
                            <img src="<?= $commento["ImmagineProfilo"] ?>" alt="profile picture"
                                 class="img-fluid" />
                        </div>
                        <div class="col">
                            <a class="fs-6 text-white m-00"
                               href="user/<?= $commento["Username"] ?>">@<?= $commento["Username"] ?></a>
                            <h4 class="fs-6 comment text-white col m-0">
                                <?= $commento["Testo"] ?>
                            </h4>
                        </div>

                        <?php if ($commento["Username"] === $_SESSION["username"]): ?>
                            <div>
                                <button type="button" class="edit-comment bg-transparent border-0"
                                        data-bs-toggle="modal" data-bs-target="#editComment">
                                    <span class="fa-solid fa-pen text-secondary"></span>
                                </button>
                                <form class="remove-comment d-inline">
                                    <input type="hidden" value="<?= $commento["NotificationID"] ?>" name="comment" />
                                    <button class="bg-transparent border-0">
                                        <span class="fa-solid fa-trash text-secondary"></span>
                                    </button>
                                </form>
                            </div>
                        <?php endif ?>

                    </article>
                <?php endforeach; ?>
            </section>
        </header>
    </article>
<?php endif; ?>
