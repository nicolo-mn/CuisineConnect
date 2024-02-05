<?php
$posts = PostController::getInstance()->getPosts();
?>

<!--<button class="btn btn-secondary rounded-pill">ADD</button>

<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Launch demo modal
</button>-->
<section class="h-100 overflow-scroll" id="feed">
    <?php
    foreach ($posts as $post) {
        require "post.php";
    }
    ?>
</section>
<!-- Modal -->
<?php require_once "form/edit-comment.php"?>
<?php require_once "form/like-list.php"?>

<script>
    function toggleDescription(postId) {
        let post = $("#" + postId);
        let image = post.find(".post-image");
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

<script src="web/js/posts.js"></script>
<script src="web/js/likes.js"></script>
<script src="web/js/comments.js"></script>
