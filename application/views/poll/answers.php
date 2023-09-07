<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Answers</title>
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/header.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/footer.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/answer.css') ?>" rel="stylesheet">
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
        <h1>Answers</h1>

        <h2>Poll:
                <?= $poll["title"] ?>
            </h2>

            <?php if ($poll["location"]): ?>
                <p>📍 Location:
                    <?= $poll["location"] ?>
                </p>
            <?php endif; ?>

            <?php if ($poll["description"]): ?>
                <h3>Description</h3>
                <p>
                    <?= $poll["description"] ?>
                </p>
            <?php endif; ?>
        <div class="answers">
        <table>
            <thead>
                <tr>
                    <th>Answer / Option</th>
                    <?php foreach ($options as $option): ?>
                        <?php if ($options_ok_max !== 0 && $options_ok[$option->getid()] === $options_ok_max): ?>
                            <th class="best">
                            <?php else: ?>
                            <th>
                            <?php endif; ?>
                            <?= $option->getstart() ?> <br>
                            <?= $option->getend() ?>
                        </th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($entries_list as $entries): ?>
                    <tr>
                        <td>
                            <?= $entries[0]->getfirstname() ?>
                            <?= $entries[0]->getname() ?>
                        </td>
                        <?php foreach ($entries as $entry): ?>
                            <td>
                                <?php if ($entry->getavailable()): ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22px" height="24" viewBox="0 0 24 24"
                                        class="Icon" aria-hidden="true" focusable="false">
                                        <path fill="currentColor" fill-rule="evenodd"
                                            d="M6.883 9.919a1.667 1.667 0 1 0-2.433 2.28l5.565 5.937 9.46-8.924a1.667 1.667 0 0 0-2.286-2.424l-7.027 6.628-3.28-3.496Z">
                                        </path>
                                    </svg>
                                <?php else: ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="22px"
                                        height="24" viewBox="0 0 24 24" class="Icon" aria-hidden="true" focusable="false">
                                        <defs>
                                            <path id="path-33"
                                                d="M2.394 2.394a1.345 1.345 0 0 1 1.902 0L8 6.098l3.704-3.704a1.345 1.345 0 0 1 1.793-.098l.109.098a1.345 1.345 0 0 1 0 1.902L9.902 8l3.704 3.704c.49.49.523 1.265.098 1.793l-.098.109a1.345 1.345 0 0 1-1.902 0L8 9.902l-3.704 3.704c-.49.49-1.265.523-1.793.098l-.109-.098a1.345 1.345 0 0 1 0-1.902L6.098 8 2.394 4.296a1.345 1.345 0 0 1-.098-1.793Z">
                                            </path>
                                        </defs>
                                        <g id="UI-/-Desktop-/-tag-voted-no-Copy" fill="none" fill-rule="evenodd" stroke="none"
                                            stroke-width="1">
                                            <g id="Group" transform="translate(4 4)">
                                                <g id="Icons/Cross">
                                                    <mask id="mask-2" fill="#fff">
                                                        <use xlink:href="#path-33"></use>
                                                    </mask>
                                                    <use xlink:href="#path-33" id="Cross" fill="currentColor" fill-rule="evenodd">
                                                    </use>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                <?php endif; ?>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>

        <p>The most available date(s) is/are framed in blue.</p>
        </div>
    </main>

    <footer>
    </footer>
</body>

</html>