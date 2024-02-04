<?php if (isset($post)): ?>
    <article id="post-<?= $post["PostID"] ?>" class="post d-flex justify-content-center g-0 post h-100 overflow-hidden">
        <div class="post-image col-md-3 overflow-hidden h-4/5 h-md-100">
            <img src="<?= $post["Foto"] ?>" alt="" class="h-100 w-100">
        </div>
        <div class="post-content col-md-3 px-3 py-2 info-block h-1/5">
            <button id="description-toggle-<?= $post["PostID"] ?>"
                    onclick="toggleDescription('post-<?= $post["PostID"] ?>')"
                    class="d-md-none rounded-circle border-0
                translate-middle-y me-3 position-absolute end-0 top-0 bg-primary h-3 w-3">
                <i class="fa-solid fa-angle-up text-secondary"></i>
            </button>
            <section class="align-items-center abs-section d-flex gap-3">
                <div
                    class="profile-pic-wrapper rounded-circle p-1 bg-white d-flex justify-content-center align-items-center ms-2">
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
                    <button class="border-0 bg-transparent">
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
            <input type="text" name="commento" placeholder="Aggiungi un commento"
                   class="w-100 border-0 text-white bg-dark rounded-pill py-2 px-3">
            <hr class="d-none d-md-block my-3 bg-white"/>
            <section>
                <?php foreach ($post["Commenti"] as $commento): ?>
                    <article class="d-none d-md-flex align-items-center mb-2 gap-2">
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
                    </article>
                <?php endforeach; ?>
            </section>
        </div>
    </article>
<?php endif; ?>
