<?php
class Admin_page_view
{
    use View_admin;
    public function show_admin_page()
    { ?>
        <a href="<?= ROOT ?>/login_admin/logout" class="btn btn-danger " style="margin-left: 1rem; margin-top: 1rem;">Logout</a>
        <div class="categories">
            <a href="<?= ROOT ?>/admin/show_news_management" style="background-image: url(<?= ROOTIMG . 'breaking_news.jpg'; ?>);">
                News
            </a>
            <a href="<?= ROOT ?>/admin/show_vehicles_management" style="background-image: url(<?= ROOTIMG . 'vehicles.jpg'; ?>);">
                Vehicles
            </a>
            <a href="<?= ROOT ?>/admin/show_users_management" style="background-image: url(<?= ROOTIMG . 'users.jpg'; ?>); color: white;">
                Users
            </a>
            <a href="<?= ROOT ?>/admin/show_feedback_management" style="background-image: url(<?= ROOTIMG . 'feedback.jpg'; ?>);">
                Feedback
            </a>
            <a href="<?= ROOT ?>/admin/show_settings" style="background-image: url(<?= ROOTIMG . 'setings.webp'; ?>);">
                Settings
            </a>
        </div>
    <?php
    }

    public function show_news_management($news)
    { ?>
        <h2>News management</h2>
    <?php
    }

    public function show_users_management($users)
    { ?>
        <form class="filtre_tri" action="<?= ROOT ?>/admin/show_users_management" method="post">
            <h2 style="margin-left: 2rem;">Filter by:</h2>
            <div class="filtres">

                <select class="form-select" name="sex">
                    <option selected value="">Sex</option>
                    <option value="M">Male</option>
                    <option value="F">Female</option>
                </select>
                <input type="text" class="form-control" placeholder=" first name" name="firstName">
                <input type="text" class="form-control" placeholder=" last name" name="lastName">
                <input type="date" class="form-control" placeholder=" birth date" name="birthDate">

                <select class="form-select" name="is_valid">
                    <option selected value="">Validity</option>
                    <option value="1">valid</option>
                    <option value="0">not valid</option>
                </select>
            </div>
            <h2 style="margin-left: 2rem;">Sort by:</h2>
            <div class="tries">
                <select class="form-select" name="sortBy">
                    <option selected value="">not selected</option>
                    <option value="firstName">first name</option>
                    <option value="lastName">last name</option>
                    <option value="birthDate">birth date</option>
                    <option value="sex">sex</option>
                    <option value="is_valid">validity</option>
                </select>
                <select class="form-select" name="sortOrder">
                    <option selected value="ASC">ascendent</option>
                    <option value="DESC">descendent</option>
                </select>
            </div>
            <input name="filter_sort" type="submit" value="Sort & Filter" class="btn btn-primary">
        </form>

        <ol class="list-group list-group-numbered px-4 my-5">
            <?php
            foreach ($users as $user) { ?>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold"><?= $user["firstName"] . " " . $user["lastName"] ?></div>
                        <?= $user["email"] ?>
                    </div>
                    <div>
                        <a target="_blank" href="<?= ROOT ?>/user/show_profile&idUser=<?= $user["idUser"] ?>" class="btn btn-primary me-2 mt-1"> show profile </a>
                        <?php if ($user["is_valid"]) { ?>
                            <a href="<?= ROOT ?>/admin/invalidate_user&idUser=<?= $user["idUser"] ?>" class="btn btn-warning me-2 mt-1"> block </a>
                        <?php } else { ?>
                            <a href="<?= ROOT ?>/admin/validate_user&idUser=<?= $user["idUser"] ?>" class="btn btn-success me-2 mt-1"> Validate </a>
                        <?php } ?>
                        <a href="<?= ROOT ?>/admin/delete_user&idUser=<?= $user["idUser"] ?>" class="btn btn-danger me-2 mt-1 sup"> Delete </a>
                    </div>
                </li>
            <?php } ?>
        </ol>
<?php
    }
}
