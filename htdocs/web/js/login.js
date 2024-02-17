'use strict';

window.onload = function() {
    document.querySelector('form').addEventListener('submit', function(event) {
        event.preventDefault();
        if (validateForm()) {
            const formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: '/login',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    const resObj = JSON.parse(response);
                    if (!resObj) {
                        const errorText = document.getElementById('errorLoginText');
                        errorText.hidden = false;
                        errorText.textContent = 'Check your informations: credentials invalid or not existent';
                    } else {
                        window.location.href = '/';
                    }
                },
            });
        }
    });
}

function validateForm() {
    $("#usernameError").attr("hidden", true);
    $("#passwordError").attr("hidden", true);
    var username = $("#username").val();
    var password = $("#password").val();

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

    return true;
}