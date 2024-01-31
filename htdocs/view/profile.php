<?php $templateParams = $GLOBALS['templateParams']?>
    <div class="col-md-8 mx-auto">
        <div class="row d-flex align-items-center py-7">
            <div class="col-4 col-md-3">
                <img src="<?php echo $templateParams["ImmagineProfilo"] ?>" alt="profile picture" class="img-fluid rounded-circle">
            </div>
            <section class="col-8 col-md-9">
                <h2 class="text-white fs-lg text-center pb-2 pb-mb-5">@<?php echo $templateParams['Username'] ?></h2>
                <section>
                    <div class="d-flex justify-content-around align-items-center">
                        <p class="text-white text-center fs-3"><?php echo (new UserController)->getPostsNumber() ?> <br> posts</p>
                        <p class="text-white text-center fs-3"><?php echo (new UserController)->getFollowers() ?> <br> seguaci</p>
                        <p class="text-white text-center fs-3"><?php echo (new UserController)->getFollowing() ?> <br> seguiti</p>
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
                <input type="submit" value="<?php echo (new UserController)->isUserFollowed() ? "Smetti di seguire" : "Segui" ?>" class="bg-secondary rounded-pill border-0 fs-4 fw-bold py-2 my-5 mx-3 mx-md-10">
                <?php endif; ?>
            </section>
        </div>
        <div class="row">
            <div class="col-6 d-flex justify-content-center align-items-center border-bottom py-3">
                <i class="fa-solid fa-table-cells fa-2x text-white"></i>
            </div>
            <div class="col-6 d-flex justify-content-center align-items-center py-3">
                <i class="fa-solid fa-user-group fa-2x text-white"></i>
            </div>
        </div>
        <div class="row row-cols-3 pt-2">
            <?php foreach((new UserController)->getPosts() as $post): ?>
            <div class="col g-0">
                <img src="<?php echo $post["Foto"] ?>" alt="food" class="img-fluid">
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    