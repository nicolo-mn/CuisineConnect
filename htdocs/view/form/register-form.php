<form id="registrationForm" action="/register" method="post" class="d-flex flex-column px-5 gap-3">
    <label for="email" hidden>E-mail</label>
    <input type="email" name="email" id="email" placeholder="Email"
           class="border-0 text-white bg-dark rounded-pill py-2 px-3">
    <span id="emailError" class="text-danger fs-7" hidden></span>
    <label for="username" hidden>Username</label>
    <input type="text" name="username" id="username" placeholder="Username"
           class="border-0 text-white bg-dark rounded-pill py-2 px-3">
    <span id="usernameError" class="text-danger fs-7" hidden></span>
    <label for="password" hidden>Password</label>
    <input type="password" name="password" id="password"
           placeholder="Password"
           class="border-0 text-white bg-dark rounded-pill py-2 px-3">
    <span id="passwordError" class="text-danger fs-7" hidden></span>
    <label for="password2" hidden>Password confirm</label>
    <input type="password" name="password2" id="password2"
           placeholder="Confirm password"
           class="border-0 text-white bg-dark rounded-pill py-2 px-3">
    <span id="password2Error" class="text-danger fs-7" hidden></span>
    <p id="errorRegistration" class="text-center text-danger" hidden></p>
    <input type="submit" value="Register" class="bg-secondary rounded-pill border-0 fs-4 fw-bold py-2">
</form>

<script src="/web/js/registration.js"></script>
