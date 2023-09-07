<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Poll</title>
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/header.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/footer.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/view.css') ?>" rel="stylesheet">
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
        <div class="container">
            <?php if (!$poll["active"]): ?>
                <div class="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="48px" height="48px">
                        <path fill="#2196f3"
                            d="M44,24c0,11.045-8.955,20-20,20S4,35.045,4,24S12.955,4,24,4S44,12.955,44,24z"></path>
                        <path fill="#fff"
                            d="M22 22h4v11h-4V22zM26.5 16.5c0 1.379-1.121 2.5-2.5 2.5s-2.5-1.121-2.5-2.5S22.621 14 24 14 26.5 15.121 26.5 16.5z">
                        </path>
                    </svg>
                    <p>This poll has been closed by the owner.</p>
                </div>
            <?php endif; ?>

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

            <h1>Poll:
                <?= $poll["title"] ?>
            </h1>

            <?php if ($poll["location"]): ?>
                <p>📍 Location:
                    <?= $poll["location"] ?>
                </p>
            <?php endif; ?>

            <?php if ($poll["description"]): ?>
                <h2>Description</h2>
                <p>
                    <?= $poll["description"] ?>
                </p>
            <?php endif; ?>

            <?= form_open() ?>
            <h2>Available slots:</h2>
            <ul>
                <?php foreach ($poll["options"] as $option): ?>
                    <li>Start:
                        <?= $option->getstart() ?> | End:
                        <?= $option->getend() ?>
                    </li>

                    <?php if ($this->session->userdata('id') != $poll["owner"] && $poll["active"]): ?>
                        <div class="check">
                            <input type="checkbox" id="option" name="option[]" value="<?= $option->getid() ?>" />
                            <label for="option">Check if you are available</label>
                        </div>
                    <?php endif; ?>

                <?php endforeach; ?>
            </ul>

            <?php if ($this->session->userdata('id') != $poll["owner"] && $poll["active"]): ?>
                <div class="name">
                    <div>
                        <h4>Name</h4>
                        <input type="text" name="name" value="" size="30" required />
                    </div>
                    
                    <div>
                        <h4>Firstname</h4>
                        <input type="text" name="firstname" value="" size="30" required />
                    </div>
                </div>

                <div class="buttons">
                    <input type="submit" id="submit" value="Vote" />
                </div>
            <?php endif; ?>

            </form>


            <?php if ($this->session->userdata('id') == $poll["owner"]): ?>
                <div id="share">
                    <p>You can share this poll with this link :
                        <a href="<?= site_url('Poll/view/' . $poll["id"]) ?> ">
                            <?php echo $_SERVER["HTTP_HOST"] . site_url('Poll/view/' . $poll["id"]) ?>
                        </a>
                    </p>
                </div>

                <div class="buttons">
                    <?= anchor('Poll/answers/' . $poll["id"], 'Answers') ?>

                    <?php if ($poll["active"]): ?>
                        <?= anchor('Poll/close/' . $poll["id"], 'Close') ?>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </main>
    <footer>
    </footer>
</body>

</html>