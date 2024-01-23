<!DOCTYPE html>
<html lang="it">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Titolo</title>
    <link rel="stylesheet" type="text/css" href="./web/bootstrap-5.0.2/dist/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="./web/css/style.css" />
    <script src="https://kit.fontawesome.com/368369d391.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary">
    <header>
        
    </header>
    <nav>
        <ul>

        </ul>
    </nav>
    <main>
        <?php if (isset($templateParams["nome"])) {
            require($templateParams["nome"]);
        }
        ?>
    </main>
</body>

</html>