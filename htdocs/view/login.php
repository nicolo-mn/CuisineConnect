<section class="p-5">
    <header class="d-flex flex-column align-items-center">
        <img src="/pub/media/CuisineConnect.svg" alt="logo" class="img-fluid col-md-6 mb-2">
        <p class="text-center text-secondary fs-7 fw-light">
            Taste the world! your flavorful adventure starts here
        </p>

        <div class="text-center">
            <p class="text-secondary fw-bold mb-1">
                <span class="fa-solid fa-mountain-city"></span>
                Share your culinary experience
            </p>
            <p class="text-secondary fw-bold">
                <span class="fa-solid fa-bowl-food"></span>
                Learn from an always growing community
            </p>
        </div>
    </header>
</section>

<?php
if ($_SERVER["REQUEST_URI"] === "/login") {
    require "form/login-form.php";
} else {
    require "form/register-form.php";
}
?>