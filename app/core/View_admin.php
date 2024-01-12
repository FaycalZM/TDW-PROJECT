<?php
trait View_admin
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
            <link rel="icon" href="<?php echo ROOTIMG ?>logo/logo-no-background.png">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
            <?php
            foreach ($css_files as $css_file) { ?>
                <link rel="stylesheet" href="<?= ROOTCSS . "/" . $css_file ?>">
            <?php } ?>
            <script src="<?= ROOTJQUERY ?>"></script>
        </head>

        <body>
        <?php
    }


    public function page_foot($js_file)
    { ?>
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
            <script src="<?= ROOTJS . $js_file ?>"></script>
        </body>

        </html>
    <?php
    }

    public function show_menu()
    { ?>
        <div class="row w-100 menu">
            <div class="col-2">
                <object data="<?php echo ROOTIMG ?>logo/logo-white.png"></object>
            </div>
            <div class="col-10">
                <ul class="row">
                    <li class="col text-center">
                        <a href="<?= ROOT ?>/admin/show_news_management">News</a>
                    </li>
                    <li class="col text-center">
                        <a href="<?= ROOT ?>/admin/show_vehicles_management">Vehicles</a>
                    </li>
                    <li class="col text-center">
                        <a href="<?= ROOT ?>/admin/show_users_management">Users</a>
                    </li>
                    <li class="col text-center">
                        <a href="<?= ROOT ?>/admin/show_feedback_management">Feedback</a>
                    </li>
                    <li class="col text-center">
                        <a href="<?= ROOT ?>/admin/show_settings">Settings</a>
                    </li>
                    <li class="col text-center">
                        <a class="btn btn-primary" href="<?= ROOT ?>/login_admin/logout">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
<?php
    }
}
