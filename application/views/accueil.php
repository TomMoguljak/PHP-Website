<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Acceuil</title>
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/header.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/footer.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/accueil.css') ?>" rel="stylesheet">
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

        <div class="menu">
            <a href="#">Product</a>
            <a href="#">Use cases</a>
            <a href="#">Professional</a>
            <a href="#">Pricing Learn</a>
            <a href="#">Contact</a>
        </div>
        <div class="button">
        <?php if (!$this->session->userdata('id')) : ?>
            <?=anchor('Connexion', 'Log in')?>
            <?=anchor('Inscription', 'Sign up')?>
        <?php else : ?>
            <?=anchor('Deconnexion', 'Log out')?>
            <?=anchor('Dashboard', 'My Dashboard')?>
            <?php endif; ?>

            <?=anchor('Poll', 'Create a Poll')?>
        </div>
    </header>

    <main>
        <div class="content">
            <div class="image">
                <img src="<?= base_url('assets/img/entreprise.png') ?>" alt="entreprise">
            </div>

            <h1>
                Professional scheduling made easy
            </h1>

            <p>SurveyLab is the fastest and easiest way to schedule anything — from meetings to the next great
                collaboration.
            </p>

        </div>
    </main>

    <footer>
    </footer>
</body>

</html>