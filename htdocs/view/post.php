<?php if (isset($post)): ?>
    <article id="post-<?= $post["PostID"] ?>" class="post d-flex flex-column flex-md-row
     justify-content-center g-0 post h-100 overflow-hidden">
        <div class="post-image col-md-3 overflow-hidden h-4/5 h-md-100">
            <img src="<?= $post["Foto"] ?>" alt="" class="h-100 w-100">
        </div>
        <div class="post-content col-md-3 px-3 py-2 info-block h-1/5 h-md-auto">
            <button id="description-toggle-<?= $post["PostID"] ?>"
                    onclick="toggleDescription('post-<?= $post["PostID"] ?>')"
                    class="d-md-none rounded-circle border-0
                translate-middle-y me-3 position-absolute end-0 top-0 bg-primary h-3 w-3">
                <i class="fa-solid fa-angle-up text-secondary"></i>
            </button>
            <section class="align-items-center abs-section d-flex gap-3">
                <div
                    class="h-5 w-5 rounded-circle p-1 bg-white d-flex justify-content-center align-items-center">
                    <div class="profile-pic-container overflow-hidden rounded-circle p-0">
                        <img
                            src="<?= $post["ImmagineProfilo"] ?>" alt=""
                            class="img-fluid">
                    </div>
                </div>
                <a class="d-none d-md-block text-white col m-0" href="user/<?= $post["Username"] ?>">
                    @<?= $post["Username"] ?>
                </a>
            </section>

            <div class="d-flex justify-content-between align-items-center">
                <h2 class="text-white fs-5 mt-3"><?= $post["Titolo"] ?></h2>
                <section class="text-white">
                    <input type="hidden" value="<?= $post["PostID"] ?>">
                    <button class="like-button <?= $post["isLike"] ? "liked" : "" ?> border-0 bg-transparent">
                        <?php if ($post["isLike"]): ?>
                            <i class="fa fa-heart text-danger"></i>
                        <?php else: ?>
                            <i class="fa-regular fa-heart text-white"></i>
                        <?php endif; ?>
                    </button>
                    <span><?= $post["NumeroLike"] ?></span>
                </section>
            </div>
            <p class="text-white description text-nowrap text-md-wrap">
                <?= $post["Descrizione"] ?>
            </p>
            <form class="commentForm">
                <input type="hidden" value="<?= $post["PostID"] ?>" name="post">
                <div class="input-group">
                    <input type="text" name="comment" placeholder="Aggiungi un commento"
                           class="form-control border-0 text-white bg-dark py-2 px-3" required/>
                    <button type="submit" class="input-group-text bg-secondary border-0">
                        <i class="fa-regular fa-paper-plane"></i>
                    </button>
                </div>
            </form>
            <hr class="d-none d-md-block my-3 bg-white"/>
            <section class="comment-section d-none mt-3 mt-md-0 d-md-block h-1/2 overflow-auto">
                <?php foreach ($post["Commenti"] as $commento): ?>
                    <article id="comment-<?= $commento["NotificationID"] ?>" class="d-flex align-items-center mb-2 gap-2">
                        <div class="profile-pic-container overflow-hidden rounded-circle p-0 h-3 w-3">
                            <img src="<?= $commento["ImmagineProfilo"] ?>" alt=""
                                 class="img-fluid">
                        </div>
                        <div class="col">
                            <a class="fs-6 text-white m-00"
                               href="user/<?= $commento["Username"] ?>">@<?= $commento["Username"] ?></a>
                            <p class="text-white col m-0">
                                <?= $commento["Testo"] ?>
                            </p>
                        </div>

                        <?php if ($commento["Username"] === $_SESSION["username"]): ?>
                            <div>
                                <button class="bg-transparent border-0">
                                    <i class="fa-solid fa-pen text-secondary"></i>
                                </button>
                                <form class="remove-comment d-inline">
                                    <input type="hidden" value="<?= $commento["NotificationID"] ?>" name="comment">
                                    <button class="bg-transparent border-0">
                                        <i class="fa-solid fa-trash text-secondary"></i>
                                    </button>
                                </form>
                            </div>
                        <?php endif ?>

                    </article>
                <?php endforeach; ?>
            </section>
        </div>
    </article>
<?php endif; ?>
