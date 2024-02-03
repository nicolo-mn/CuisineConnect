<?php $templateParams = $GLOBALS['templateParams']?>
<div class="col-md-8 mx-auto">
    <div class="row d-flex align-items-center py-7">
        <div class="col-4 col-md-3">
            <img src="<?php echo $templateParams["ImmagineProfilo"] ?>" alt="immagine profilo" class="img-fluid rounded-circle">
        </div>
        <section class="col-8 col-md-9">
            <h2 id="username" class="text-white fs-lg text-center pb-2 pb-mb-5">@<?php echo $templateParams['Username'] ?></h2>
            <section>
                <div class="d-flex justify-content-around align-items-center">
                    <p class="text-white text-center fs-3"><?php echo $templateParams['NumeroPost'] ?> <br> posts</p>
                    <p class="text-white text-center fs-3"><span id="followers"><?php echo $templateParams['NumeroFollower'] ?></span> <br> seguaci</p>
                    <p class="text-white text-center fs-3"><?php echo $templateParams['NumeroFollowing'] ?> <br> seguiti</p>
                </div>
            </section>
        </section>
    </div>
    <div class="row">
        <section class="d-flex flex-column">
            <h2 class="text-white fs-lg pb-3"><?php echo $templateParams["Nome"]?></h2>
            <p class="text-white fs-4">
            <?php echo $templateParams["Bio"]?>
            </p>
            <?php if($templateParams["UserID"] != $_SESSION["user_id"]): ?>
            <input type="submit" id="followBtn" value="<?php echo UserController::getInstance()->isUserFollowed($templateParams["UserID"]) ? "Smetti di seguire" : "Segui" ?>" class="bg-secondary rounded-pill border-0 fs-4 fw-bold py-2 my-5 mx-3 mx-md-10">
            <?php endif; ?>
        </section>
    </div>
    <div class="row">
        <a href="#" class="text-decoration-none col-6" id="posted">
            <div class="d-flex justify-content-center align-items-center py-3">
                <i class="fa-solid fa-table-cells fa-2x text-white"></i>
            </div>
        </a>
        <a href="#" class="text-decoration-none col-6" id="mentioned">
            <div class="d-flex justify-content-center align-items-center py-3">
                <i class="fa-solid fa-user-group fa-2x text-white"></i>
            </div>
        </a>
    </div>
    <div class="row row-cols-3 pt-2" id="post-tab"></div>
</div>


<script src="/web/js/profile.js" type="text/javascript"></script>
    