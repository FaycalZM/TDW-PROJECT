<?php

trait View
{
    public function page_head($css_file, $page_title)
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
            <link rel="stylesheet" href="<?= ROOTCSS . "/" . $css_file ?>">
        </head>

        <body>
        <?php
    }




    public function page_foot($js_file)
    { ?>
            <script src="<?= ROOTJS . "/" . $js_file ?>"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
        </body>

        </html>
    <?php
    }




    public function show_menu()
    { ?>
        <div class="divmenu">
            <div class="contact row">
                <div class="col-6">
                    <a href="mailto: abc@example.com">Send Email</a>
                    <a href="tel:+213785652396">0672025944</a>
                </div>
                <div class="col-6">
                    <a href="#"><img src="<?= ROOTIMG ?>/instagram.png" alt=""></a>
                    <a href="#"><img src="<?= ROOTIMG ?>/facebook.png" alt=""></a>
                    <a href="#"><img src="<?= ROOTIMG ?>/telegram.png" alt=""></a>
                    <a href="#"><img src="<?= ROOTIMG ?>/linkedin.png" alt=""></a>
                </div>
            </div>
            <div class="row w-100 menu">
                <div class="col-2">
                    <object data="<?= ROOTIMG ?>/logo.svg"></object>
                </div>
                <div class="col-10">
                    <ul class="row">
                        <li class="col text-center">
                            <a href="http://localhost/Projet_TDW/public/">HomePage</a>
                        </li>
                        <li class="col text-center">
                            <a href="http://localhost/Projet_TDW/public/news/afficher_news">News</a>
                        </li>
                        <li class="col text-center">
                            <a href="http://localhost/Projet_TDW/public/idee_recette/afficher_form_page">Comparator</a>
                        </li>
                        <li class="col text-center">
                            <a href="http://localhost/Projet_TDW/public/healthy/afficher_healthy_recettes">Brands</a>
                        </li>
                        <li class="col text-center">
                            <a href="http://localhost/Projet_TDW/public/saison/afficher_recette_of_saison&saison=">Feedback</a>
                        </li>
                        <li class="col text-center">
                            <a href="http://localhost/Projet_TDW/public/fete/afficher_recette_de_fete&fete=">Guides</a>
                        </li>
                        <li class="col text-center">
                            <a href="http://localhost/Projet_TDW/public/contact/afficher_contact">Contact</a>
                        </li>
                        <li class="login col text-center">
                            <object data="<?= ROOTIMG ?>setting.svg" type=""></object>
                            <ul><?php
                                if (isset($_SESSION["token"]) && isset($_SESSION["id"])) { ?>
                                    <li><a href="http://localhost/Projet_TDW/public/user/deconnect"> Deconnect </a></li>
                                    <li><a href="http://localhost/Projet_TDW/public/user/afficher_profile"> Profil </a></li>
                                <?php
                                } else { ?>
                                    <li><a href="http://localhost/Projet_TDW/public/user/afficher_login_page&message="> Login </a></li>
                                <?php
                                } ?>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    <?php
    }






    public function show_page_footer()
    { ?>
        <footer class="text-center text-white" style="background-color: #f1f1f1;margin-top:35px;">
            <div class="container pt-4">
                <section class="mb-4">
                    <ul class="row" style="list-style: none;">
                        <li class="col text-decoration-none"><a href="http://localhost/Projet_TDW/public/"> Homepage </a></li>
                        <li class="col text-decoration-none"><a href="http://localhost/Projet_TDW/public/news/afficher_news"> News </a></li>
                        <li class="col text-decoration-none"><a href="http://localhost/Projet_TDW/public/idee_recette/afficher_form_page"> Comparator</a></li>
                        <li class="col text-decoration-none"><a href="http://localhost/Projet_TDW/public/healthy/afficher_healthy_recettes"> Brands</a></li>
                        <li class="col text-decoration-none"><a href="http://localhost/Projet_TDW/public/saison/afficher_recette_of_saison&saison="> Feedback</a></li>
                        <li class="col text-decoration-none"><a href="http://localhost/Projet_TDW/public/fete/afficher_recette_de_fete&fete="> Guides</a></li>
                        <li class="col text-decoration-none"><a href="http://localhost/Projet_TDW/public/contact/afficher_contact"> Contact</a></li>
                    </ul>
                </section>
            </div>
            <div class="text-center text-dark p-3" style="background-color: rgba(0, 0, 0, 0.2);">
                © 2024 Copyright <a class="text-dark" href="#">ESI</a>
            </div>
        </footer>
    <?php
    }


    public function show_filter()
    { ?>
        <form class="filtres" id="filtres">
            <select class="form-select saison_filre" aria-label="Default select example">
                <option selected>Saison</option>
                <option value="hiver">Hiver</option>
                <option value="printemps">Printemps</option>
                <option value="été">Eté</option>
                <option value="automne">Automne</option>
            </select>
            <input type="number" class="form-control temp_prepa_filtr" placeholder=" Temp de préparation" aria-describedby="basic-addon1">
            <input type="number" class="form-control temp_cuis_filtr" placeholder=" Temp de cuisson" aria-describedby="basic-addon1">
            <input type="number" class="form-control temp_total_filtr" placeholder=" Temp total" aria-describedby="basic-addon1">
            <input type="number" class="form-control notation_filtr" placeholder=" Notation" aria-describedby="basic-addon1" min="1" max="10">
            <input type="number" class="form-control calories_filtr" placeholder=" Nombre de calories" aria-describedby="basic-addon1">
            <button type="submit" class="btn btn-primary filre" id="filtr"> Filtrer </button>
        </form>


        <form class="tries" id="tries">
            <select class="form-select type_tri" aria-label="Default select example">
                <option selected>Trier par </option>
                <option value="temp_prepa">Temp de préparation</option>
                <option value="temp_cuis">Temp de cuisson</option>
                <option value="temp_total">Temp total</option>
                <option value="calories">Nombre de calories</option>
                <option value="notation">Notation</option>
            </select>
            <select class="form-select ordre_tri" aria-label="Default select example">
                <option selected>Par ordre</option>
                <option value="croissant">Croissant</option>
                <option value="decroissant">Decroissant</option>
            </select>
            <button type="submit" class="btn btn-primary tri"> Trier </button>
        </form>
<?php
    }
}
