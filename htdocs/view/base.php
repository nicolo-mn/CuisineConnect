<!DOCTYPE html>
<html lang="it">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Titolo</title>
    <link rel="stylesheet" type="text/css" href="/web/bootstrap-5.0.2/dist/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="/web/css/style.css" />
    <link rel="stylesheet" type="text/css" href="/web/css/jquery-ui.min.css" />

</head>

<body class="bg-primary d-flex flex-column">
    <?php require "view/components/header.php"; ?>
    <script src="/web/bootstrap-5.0.2/dist/js/bootstrap.bundle.js"></script>
    <script src="https://kit.fontawesome.com/368369d391.js" crossorigin="anonymous"></script>
    <script src="/web/js/jquery.min.js" crossorigin="anonymous"></script>
    <script src="/web/js/jquery-ui.min.js" crossorigin="anonymous"></script>
    <main class="flex-grow-1 overflow-auto container-fluid p-0">
        <?php if (isset($templateParams["nome"])) {
            require($templateParams["nome"]);
        }
        ?>
    </main>
</body>

</html>