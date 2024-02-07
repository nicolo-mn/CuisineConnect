<?php $templateParams = $GLOBALS['templateParams'] ?>
<div class="col-md-8 mx-auto">
    <div class="row d-flex align-items-center py-3 mx-0">
        <div class="col-4 col-md-3">
            <div class="ratio ratio-1x1">
                <img src="<?php echo $templateParams["ImmagineProfilo"] ?>" alt="profile picture"
                     class="img-fluid rounded-circle">
            </div>
        </div>
        <section class="col-8 col-md-9">
            <h2 id="username" class="text-white text-center pb-2 pb-mb-5 pe-4">@<?php echo $templateParams['Username'] ?></h2>
            <div class="d-flex justify-content-around align-items-center">
                <p class="text-white text-center"><?php echo $templateParams['NumeroPost'] ?> <br> posts</p>
                <button type="button" class="followers-list bg-transparent border-0 p-0" data-bs-toggle="modal" data-bs-target="#followersList">
                    <span class="text-white text-center"><span id="followers"><?php echo $templateParams['NumeroFollower'] ?></span> <br> followers</span>
                </button>
                <button type="button" class="following-list bg-transparent border-0 p-0" data-bs-toggle="modal" data-bs-target="#followingList">
                    <span class="text-white text-center"><?php echo $templateParams['NumeroFollowing'] ?> <br> following</span>
                </button>
            </div>
        </section>
    </div>
    <div class="row mx-0">
        <section class="d-flex flex-column">
            <h2 class="text-white pb-1"><?php echo $templateParams["Nome"] ?></h2>
            <p class="text-white fs-4">
                <?php echo $templateParams["Bio"] ?>
            </p>
            <?php if ($templateParams["UserID"] != $_SESSION["user_id"]): ?>
                <input type="submit" id="followBtn"
                       value="<?php echo UserController::getInstance()->isUserFollowed($templateParams["UserID"]) ? "Unfollow" : "Follow" ?>"
                       class="bg-secondary rounded-pill border-0 fs-4 fw-bold py-2 my-5 mx-3 mx-md-10">
            <?php endif; ?>
            <?php if ($templateParams["UserID"] == $_SESSION["user_id"]): ?>
                <a href="/logout" class="btn btn-secondary my-2 shadow-none">Log out</a>
            <?php endif; ?>
        </section>
    </div>
    <div class="row mx-0">
        <a href="#" class="text-decoration-none col-6 border-bottom" id="posted">
            <div class="d-flex justify-content-center align-items-center py-3">
                <span class="fa-solid fa-table-cells fa-2x text-white"></span>
            </div>
        </a>
        <a href="#" class="text-decoration-none col-6" id="mentioned">
            <div class="d-flex justify-content-center align-items-center py-3">
                <span class="fa-solid fa-user-group fa-2x text-white"></span>
            </div>
        </a>
    </div>
    <div class="row row-cols-3 pt-2 mx-0" id="post-tab">
        <?php foreach (PostController::getInstance()->getUserPosts($templateParams["UserID"]) as $post): ?>
            <div class="col g-0">
                <button class="show-post border-0 ratio ratio-1x1" data-bs-toggle="modal" data-bs-target="#popupPost">
                    <img src="<?php echo $post["Foto"] ?>" alt="post picture" class="img-fluid">
                </button>
                <input type="hidden" value="<?= $post["PostID"] ?>">
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require_once "view/modals/popup-post.php"; ?>
<?php require_once "view/modals/followers-list.php"; ?>
<?php require_once "view/modals/following-list.php"; ?>
<?php require_once "form/edit-comment.php"?>
<?php require_once "form/like-list.php"?>

<script src="web/js/posts.js"></script>
<script src="web/js/likes.js"></script>
<script src="web/js/comments.js"></script>
<script src="/web/js/profile.js"></script>
