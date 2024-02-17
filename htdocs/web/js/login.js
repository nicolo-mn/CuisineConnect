'use strict';

window.onload = function() {
    document.querySelector('form').addEventListener('submit', function(event) {
        event.preventDefault();
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
    });
}