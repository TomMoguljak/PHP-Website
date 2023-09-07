<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Poll Create</title>
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/header.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/footer.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/poll.css') ?>" rel="stylesheet">
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

                    <div>
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
                </div>
            <?php endif; ?>
            <h1>Create your Poll</h1>
            <?= form_open(); ?>

            <h4>Title</h4>
            <input type="text" name="title" value="" size="30" required />

            <h4>Location (optional)</h4>
            <input type="text" name="location" value="" size="40" />

            <h4>Description (optional)</h4>
            <textarea name="description" maxlength="500"></textarea>

            <div class="options">
                <div>
                    <h4>Date Start</h4>
                    <input type="datetime-local" name="datestart[]" value="" required />


                    <h4>Date End</h4>
                    <input type="datetime-local" name="dateend[]" value="" required />

                    <input class="button" onclick="remove(event)" type="button" value="Remove Date" />
                </div>
            </div>

            <div class="buttons">
                <input class="button" type="button" id="add" value="Add Date" />
                <input class="button" type="submit" id="submit" value="Create" />
            </div>
            </form>
        </div>
    </main>

    <footer>
    </footer>

    <script src="<?= base_url('assets/js/poll.js') ?>"></script>
</body>

</html>