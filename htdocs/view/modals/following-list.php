<div class="modal fade" id="followingList" tabindex="-1" aria-labelledby="followingList" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5">Following:</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php foreach (UserController::getInstance()->getFollowingList($templateParams["UserID"]) as $follower): ?>
                    <a href="/user/<?= $follower["Username"] ?>" class="text-decoration-none">
                        <div class="row user-searched mx-0">
                            <div class="d-flex justify-content-start py-3 align-items-center">
                                <div class="col-1 me-3">
                                    <div class="ratio ratio-1x1">
                                        <img src="<?= $follower["ImmagineProfilo"] ?>" alt="profile picture" class="img-fluid rounded-circle">
                                    </div>
                                </div>
                                <p class="m-0">@<?= $follower["Username"] ?></p>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>   
            </div>
        </div>
    </div>
</div>