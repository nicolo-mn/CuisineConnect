<?php if (isset($post)): ?>
    <section class="row justify-content-center g-0 post h-100 overflow-hidden">
        <div class="col-md-3 overflow-hidden">
            <img src="<?= $post["Foto"] ?>" alt="" class="h-100 w-100">
        </div>
        <div class="col-md-3 p-5 info-block">
            <i class="d-md-none fa-solid fa-angle-up text-secondary bg-primary p-3 rounded-circle expand-icon"></i>
            <section class="row align-items-center abs-section">
                <div class="profile-pic-container overflow-hidden rounded-circle p-0">
                    <img src="<?= $post["Foto"] ?>" alt=""
                         class="img-fluid">
                </div>
                <p class="d-none d-md-block text-white col m-0">
                    Marco Rossi
                </p>
            </section>
            <h2 class="text-white fs-5 mt-3"><?= $post["Titolo"] ?></h2>
            <p class="text-white description">
                <?= $post["Descrizione"] ?>
            </p>
            <input type="text" name="commento" placeholder="Aggiungi un commento"
                   class="w-100 border-0 text-white bg-dark rounded-pill py-2 px-3">
            <hr class="d-none d-md-block my-3 bg-white"/>
            <?php foreach ($post["Commenti"] as $commento): ?>
                <section class="d-none d-md-flex row align-items-center mb-2">
                    <div class="profile-pic-container overflow-hidden rounded-circle p-0">
                        <img src="<?= $commento["ImmagineProfilo"] ?>" alt=""
                             class="img-fluid">
                    </div>
                    <div class="col">
                        <h3 class="fs-6 text-white m-00">@<?= $commento["Username"] ?></h3>
                        <p class="text-white col m-0">
                            <?= $commento["Testo"] ?>
                        </p>
                    </div>
                </section>
            <?php endforeach; ?>
        </div>
    </section>
<?php endif; ?>