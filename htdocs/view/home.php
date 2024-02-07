<?php
$posts = PostController::getInstance()->getPosts();
?>

<!--<button class="btn btn-secondary rounded-pill">ADD</button>

<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Launch demo modal
</button>-->
<div class="d-flex justify-content-end h-100">
    <section class="h-100 overflow-scroll align-items-center w-md-3/4 w-lg-1/2" id="feed">
        <h1 hidden>CuisineConnect Home Feed</h1>
        <?php if (isset($posts)) {
            foreach ($posts as $post) {
                require "post.php";
            }
        }
        ?>
    </section>
    <section class="d-none d-md-block w-1/4 border-start border-dark overflow-auto">
        <h3 class="text-white text-center">Notifications</h3>
        <?php
        InteractionController::getInstance()->loadNotifications();
        require "notifications.php";
        ?>
    </section>
</div>
<!-- Modal -->
<?php require_once "form/edit-comment.php" ?>
<?php require_once "form/like-list.php" ?>

<script src="/web/js/likes.js"></script>
<script src="/web/js/comments.js"></script>
<script src="/web/js/home-slide.js"></script>


