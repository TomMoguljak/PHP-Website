<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/header.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/footer.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/connexion.css') ?>" rel="stylesheet">
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
            <?php if (validation_errors() || isset($error)): ?>
                <div class="alert">
                    <img src="<?= base_url('assets/img/warning.png') ?>" alt="error" width="48px" height="48px">

                    <?php if (validation_errors()): ?>
                        <p>
                            <?= validation_errors() ?>
                        </p>
                    <?php endif; ?>

                    <?php if (isset($error)): ?>
                        <p>
                            <?= $error ?>
                        </p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <h1>Nice to see you again</h1>
            <?= form_open(); ?>

            <h4>Email Address</h4>
            <input type="email" name="email" value="" size="50" required />

            <h4>Password</h4>
            <input type="password" name="password" value="" size="50" required />

            <div class='button'>
                <input type="submit" id="submit" value="Log in" />
            </div>
            </form>

            <div class="signup">
                <p>Don't have an account ? <a href=<?= site_url('Inscription') ?>>Sign up</a></p>
            </div>
        </div>
    </main>

    <footer>
    </footer>
</body>

</html>