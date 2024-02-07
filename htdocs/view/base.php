<!DOCTYPE html>
<html lang="it">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>CuisineConnect</title>
    <link rel="stylesheet" type="text/css" href="/web/bootstrap-5.0.2/dist/css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="/web/bootstrap-5.0.2/dist/css/bootstrap-utilities.css"/>
    <link rel="stylesheet" type="text/css" href="/web/css/style.css"/>
    <link rel="stylesheet" type="text/css" href="/web/css/jquery-ui.min.css"/>

</head>

<body class="bg-primary d-flex flex-column">
<?php require "view/components/header.php"; ?>
<script src="/web/bootstrap-5.0.2/dist/js/bootstrap.bundle.js"></script>
<script src="https://kit.fontawesome.com/368369d391.js" crossorigin="anonymous"></script>
<script src="/web/js/jquery.min.js" crossorigin="anonymous"></script>
<script src="/web/js/jquery-ui.min.js" crossorigin="anonymous"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var sidebar = document.querySelector('nav > ul');
        sidebar.style.right = '-250px';
        var menuBtn = document.querySelector('.menu-btn');
        console.log(menuBtn)

        // Funzione per aprire/chiudere il menu
        function toggleMenu() {
            console.log("clicked")
            $(sidebar).toggleClass("d-none", 0,"easeOutSine", function () {
                console.log("dfsfd");
                if (sidebar.style.right === '0px') {
                    sidebar.style.right = '-250px';
                } else {
                    sidebar.style.right = '0px';
                }
            });

        }

        // Event listener per il pulsante del menu
        menuBtn.addEventListener('click', toggleMenu);

        // Event listener per il clic al di fuori del menu per chiuderlo
        document.addEventListener('click', function (event) {
            var target = event.target;
            if (target !== menuBtn && !sidebar.contains(target)) {
                sidebar.style.right = '-250px';
                $(sidebar).addClass("d-none");
            }
        });
    });


</script>
<main class="flex-grow-1 overflow-<?= ($_SERVER["REQUEST_URI"] === "/") ? "hidden" : "auto"?>  container-fluid p-0">
    <?php if (isset($templateParams["nome"])) {
        require($templateParams["nome"]);
    }
    ?>
</main>
</body>

</html>