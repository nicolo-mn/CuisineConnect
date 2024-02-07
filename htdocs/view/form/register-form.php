<form id="registrationForm" action="/register" method="post" class="d-flex flex-column px-5 gap-3">
    <label for="email" hidden>E-mail</label>
    <input type="email" name="email" id="email" placeholder="email"
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
    <input type="submit" value="Register" class="bg-secondary rounded-pill border-0 fs-4 fw-bold py-2">
</form>

<script>
    addEventListener("DOMContentLoaded", (event) => {
        // Quando il documento è pronto
        $(document).ready(function () {
            // Ascolta l'evento di sottoposizione del form
            $("#registrationForm").submit(function (event) {
                // Effettua la validazione
                if (!validateForm()) {
                    // Se la validazione non passa, annulla la sottoposizione del form
                    event.preventDefault();
                }
            });
        });

        function validateForm() {
            var username = $("#username").val();
            var email = $("#email").val();
            var password = $("#password").val();
            var confirmPassword = $("#password2").val();

            // Validazione Email
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                $("#emailError").html("Inserisci un indirizzo email valido.");
                $("#emailError").removeAttr("hidden");
                return false;
            }

            // Validazione Username
            if (username.length < 3) {
                $("#usernameError").html("L'username deve essere lungo almeno 3 caratteri.")
                $("#usernameError").removeAttr("hidden");
                return false;
            }

            // Validazione Password
            if (password.length < 6) {
                $("#passwordError").html("La password deve essere lunga almeno 6 caratteri.");
                $("#passwordError").removeAttr("hidden");
                return false;
            }

            // Confronto Password e Conferma Password
            if (password !== confirmPassword) {
                $("#password2Error").html("Le password non corrispondono.");
                $("#passwordError").removeAttr("hidden");
                return false;
            }

            return true;
        }
    });
</script>