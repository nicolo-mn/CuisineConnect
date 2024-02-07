<form action="/login" method="post" class="d-flex flex-column px-5 gap-3">
    <label for="username" hidden>Username:</label>
    <input type="text" id="username" name="username" placeholder="Username" class="border-0 text-white bg-dark rounded-pill py-2 px-3">

    <label for="password" hidden>Password:</label>
    <input type="password" id="password" name="password" placeholder="Password" class="border-0 text-white bg-dark rounded-pill py-2 px-3">

    <input type="submit" value="Login" class="bg-secondary rounded-pill border-0 fs-4 fw-bold py-2">
</form>
<div class="d-flex flex-column px-5 gap-3">
    <p class="text-secondary fw-light fs-sm">New to CuisineConnect?</p>
    <a href="/register" class="bg-secondary rounded-pill border-0 fs-4 fw-bold py-2 text-center text-decoration-none">Register</a>
</div>