<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Success</title>
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/header.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/footer.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/success.css') ?>" rel="stylesheet">
</head>

<body>
    <header>
        <a id="home" href="<?= site_url('Accueil') ?>">
            <div class="logo">
                <img src="<?= base_url('assets/img/Logo.png') ?>" alt="logo">
            </div>
            <div class="title">
                SurveyLab
            </div>
        </a>

        <div class="button">
            <?= anchor('Poll', 'Create a Poll') ?>
        </div>
    </header>

    <main>
            <img src="//http.cat/202.jpg">
    </main>

    <footer>
    </footer>
</body>

</html>