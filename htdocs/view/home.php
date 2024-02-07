<?php
$posts = PostController::getInstance()->getPosts();
?>

<!--<button class="btn btn-secondary rounded-pill">ADD</button>

<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Launch demo modal
</button>-->
<div class="d-flex justify-content-end h-100">
    <section class="h-100 overflow-scroll align-items-center w-md-3/4 w-lg-1/2" id="feed">
        <h1 class="hide">CuisineConnect Home Feed</h1>
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

<script>
    function toggleDescription(postId) {
        let post = $("#" + postId);
        let image = post.find(".post-media");
        let content = post.find(".post-content");
        let description = content.find(".description");
        let comments = content.find(".comment-section")

        let imageClass = image.hasClass("h-4/5") ? "h-1/5" : "h-4/5";
        let contentClass = content.hasClass("h-4/5") ? "h-1/5" : "h-4/5";
        comments.toggleClass("d-none");

        image.removeClass("h-4/5 h-1/5").addClass(imageClass, 300, "swing");
        content.removeClass("h-4/5 h-1/5").addClass(contentClass, 300, "swing");
        description.toggleClass("text-nowrap");
    }
</script>

<script src="web/js/likes.js"></script>
<script src="web/js/comments.js"></script>
<script src="web/js/home-slide.js"></script>


