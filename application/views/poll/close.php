<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Close</title>
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/header.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/footer.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/close.css') ?>" rel="stylesheet">
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
        <?php if ($result == false): ?>
            <img src="//http.cat/401.jpg">
        <?php else: ?>
            <p>
                The poll has been closed.
            </p>

            <div class="button">
                <?= anchor('Poll/view/' . $id, 'Back to the poll') ?>
            </div>
        <?php endif; ?>

    </main>

    <footer>
    </footer>
</body>

</html>