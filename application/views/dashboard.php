<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/header.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/footer.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/dashboard.css') ?>" rel="stylesheet">
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
        <h1>
            Dashboard
        </h1>
        <div class="list">
            <?php if (count($polls) > 0): ?>
                <?php foreach ($polls as $poll): ?>
                    <a href="<?= site_url('Poll/view/' . $poll["id"]) ?>">
                        <div>
                            <h4>
                                <?= $poll["title"] ?>
                            </h4>
                            <p>
                                <?= $poll["location"] ?>
                            </p>
                            <p>
                                <?= $poll["description"] ?>
                            </p>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php else: ?>
                <p>
                    You are a lonely person, you have no poll.
                </p>
            <?php endif; ?>
        </div>
    </main>

    <footer>
    </footer>
</body>

</html>