<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/header.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/footer.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/inscription.css') ?>" rel="stylesheet">
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
    </header>

    <main>
        <div class="container">
            <?php if (validation_errors()): ?>
                <div class="alert">
                    <img src="<?= base_url('assets/img/warning.png') ?>" alt="error" width="48px" height="48px">

                    <?php if (validation_errors()): ?>
                        <p>
                            <?= validation_errors() ?>
                        </p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <h1>Welcome to SurveyLab</h1>
            <?= form_open(); ?>

            <h4>Name</h4>
            <input type="text" name="name" value="" size="30" required />

            <h4>Firstname</h4>
            <input type="text" name="firstname" value="" size="30" required />

            <h4>Email Address</h4>
            <input type="email" name="email" value="" size="40" required />

            <h4>Password</h4>
            <input type="password" name="password" value="" size="50" required />

            <h4>Confirm Password</h4>
            <input type="password" name="confirm_password" value="" size="50" required />

            <div class="check">
                <input type="checkbox" id="confirm" name="confirm" />
                <label for="confirm">I agree to the terms and conditions</label>
            </div>

            <div class='button'>
                <input type="submit" id="submit" value="Sign up" disabled />
            </div>
            </form>

            <div class="login">
                <p>Already have an account ? <a href=<?= site_url('Connexion') ?>>Log in</a></p>
            </div>
        </div>
    </main>

    <footer>
    </footer>

    <script src="<?= base_url('assets/js/inscription.js') ?>"></script>
</body>

</html>