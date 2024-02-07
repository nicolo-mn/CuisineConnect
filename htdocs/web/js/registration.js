addEventListener("DOMContentLoaded", (event) => {
    $(document).ready(function () {
        $("#registrationForm").submit(function (event) {
            if (!validateForm()) {
                event.preventDefault();
            }
        });
    });

    function validateForm() {
        var username = $("#username").val();
        var email = $("#email").val();
        var password = $("#password").val();
        var confirmPassword = $("#password2").val();

        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            $("#emailError").html("Insert a valid email address.");
            $("#emailError").removeAttr("hidden");
            return false;
        }

        if (username.length < 3) {
            $("#usernameError").html("Username must be at least 3 characters long.")
            $("#usernameError").removeAttr("hidden");
            return false;
        }

        if (password.length < 6) {
            $("#passwordError").html("Password must be at least 6 characters long.");
            $("#passwordError").removeAttr("hidden");
            return false;
        }

        if (password !== confirmPassword) {
            $("#password2Error").html("Passwords don't match.");
            $("#passwordError").removeAttr("hidden");
            return false;
        }

        return true;
    }
});