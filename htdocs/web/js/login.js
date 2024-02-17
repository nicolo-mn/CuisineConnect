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
                    document.getElementById('errorLoginText').hidden = false;
                } else {
                    window.location.href = '/';
                }
            },
        });
    });
}