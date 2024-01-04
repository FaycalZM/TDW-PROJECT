<?php
session_start();

trait View
{
    public function page_head($css_files, $page_title)
    { ?>
        <!doctype html>
        <html lang="en">

        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta http-equiv="cache-control" content="no-cache" />
            <meta http-equiv="Pragma" content="no-cache" />
            <meta http-equiv="Expires" content="-1" />
            <title><?= $page_title ?></title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
            <?php
            foreach ($css_files as $css_file) { ?>
                <link rel="stylesheet" href="<?= ROOTCSS . "/" . $css_file ?>">
            <?php } ?>
            <script src="<?= ROOTJQUERY ?>"></script>
        </head>

        <body>
            <main class="main-page">
            <?php
        }

        public function page_foot($js_file)
        { ?>
            </main>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
            <script src="<?= ROOTJS . "/" . $js_file ?>"></script>
        </body>

        </html>
    <?php
        }

        public function show_page_header()
        { ?>
        <header>
            <div class="logo">
                <a href="<?= ROOT ?>">
                    <img src="<?= ROOTIMG ?>/logo/logo-no-background.png" alt="Logo">
                </a>

            </div>

            <ul class="social-links">
                <li>
                    <a href="#"><img src="<?= ROOTIMG ?>/social/instagram.png" alt=""></a>
                </li>
                <li>
                    <a href="#"><img src="<?= ROOTIMG ?>/social/facebook.png" alt=""></a>
                </li>
                <li>
                    <a href="#"><img src="<?= ROOTIMG ?>/social/telegram.png" alt=""></a>
                </li>
                <li>
                    <a href="#"><img src="<?= ROOTIMG ?>/social/linkedin.png" alt=""></a>
                </li>
            </ul>
        </header>
    <?php
        }

        public function show_menu()
        {
    ?>
        <ul class="nav-menu">
            <li><a href="<?= ROOT ?>"> Homepage </a></li>
            <li><a href="<?= ROOT ?>/news/afficher_news"> News </a></li>
            <li><a href="<?= ROOT ?>/comparator/afficher_form_page"> Comparator</a></li>
            <li><a href="<?= ROOT ?>/brands/afficher_healthy_recettes"> Brands</a></li>
            <li><a href="<?= ROOT ?>/feedback/afficher_recette_of_saison&saison="> Feedback</a></li>
            <li><a href="<?= ROOT ?>/guides/afficher_recette_de_fete&fete="> Guides</a></li>
            <li><a href="<?= ROOT ?>/contact/afficher_contact"> Contact</a></li>
            <li>
                <?php
                if (isset($_SESSION["id"])) { ?>
            <li><a href="<?= ROOT ?>/user/logout"> Logout </a></li>
            <li><a href="<?= ROOT ?>/user/show_profile"> Profile </a></li>
        <?php
                } else { ?>
            <li><a href="<?= ROOT ?>/user/show_login_page/"> Login </a></li>
        <?php
                } ?>

        </li>
        </ul>
    <?php }

        public function show_page_footer()
        { ?>
        <footer>
            <div class="footer-menu">
                <ul style="list-style: none;">
                    <li><a href="<?= ROOT ?>"> Homepage </a></li>
                    <li><a href="<?= ROOT ?>/news/afficher_news"> News </a></li>
                    <li><a href="<?= ROOT ?>/comparator/afficher_form_page"> Comparator</a></li>
                    <li><a href="<?= ROOT ?>/brands/afficher_healthy_recettes"> Brands</a></li>
                    <li><a href="<?= ROOT ?>/feedback/afficher_recette_of_saison&saison="> Feedback</a></li>
                    <li><a href="<?= ROOT ?>/guides/afficher_recette_de_fete&fete="> Guides</a></li>
                    <li><a href="<?= ROOT ?>/contact/afficher_contact"> Contact</a></li>
                </ul>
            </div>
            <div class="copyright">
                © 2024 Copyright <a href="#">ESI</a>
            </div>
        </footer>
    <?php
        }



        public function show_filter()
        { ?>
        <form id="filtres">
            <select aria-label="Default select example">
                <option selected>Saison</option>
                <option value="hiver">Hiver</option>
                <option value="printemps">Printemps</option>
                <option value="été">Eté</option>
                <option value="automne">Automne</option>
            </select>
            <input type="number" placeholder=" Temp de préparation" aria-describedby="basic-addon1">
            <input type="number" placeholder=" Temp de cuisson" aria-describedby="basic-addon1">
            <input type="number" placeholder=" Temp total" aria-describedby="basic-addon1">
            <input type="number" placeholder=" Notation" aria-describedby="basic-addon1" min="1" max="10">
            <input type="number" placeholder=" Nombre de calories" aria-describedby="basic-addon1">
            <button type="submit"> Filtrer </button>
        </form>

        <form id="tries">
            <select aria-label="Default select example">
                <option selected>Trier par </option>
                <option value="temp_prepa">Temp de préparation</option>
                <option value="temp_cuis">Temp de cuisson</option>
                <option value="temp_total">Temp total</option>
                <option value="calories">Nombre de calories</option>
                <option value="notation">Notation</option>
            </select>
            <select aria-label="Default select example">
                <option selected>Par ordre</option>
                <option value="croissant">Croissant</option>
                <option value="decroissant">Decroissant</option>
            </select>
            <button type="submit"> Trier </button>
        </form>
<?php
        }
    }
