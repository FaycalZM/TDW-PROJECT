<?php
class Admin_page_view
{
    use View_admin;
    public function show_admin_page()
    { ?>
        <a href="<?= ROOT ?>/login_admin/logout" class="btn btn-primary Logout">Deconnecter</a>
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

        <ol class="list-group list-group-numbered px-4 my-5"><?php
                                                                foreach ($users as $user) { ?>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold"><?php echo $user["firstName"] . " " . $user["lastName"] ?></div>
                        <?php echo $user["email"] ?>
                    </div>
                    <span>
                        <a target="_blank" href="<?= ROOT ?>/admin/show_user_profile&id_user=<?php echo $user["idUser"] ?>" class="btn btn-primary me-2 mt-1"> show profile </a>
                        <?php
                                                                    if ($user["is_valid"]) {
                        ?>
                            <a href="<?= ROOT ?>/admin/invalidate_user&idUser=<?php echo $user["idUser"] ?>" class="btn btn-warning me-2 mt-1"> block </a><?php
                                                                                                                                                        } else { ?>
                            <a href="<?= ROOT ?>/admin/validate_user&idUser=<?php echo $user["idUser"] ?>" class="btn btn-success me-2 mt-1"> Validate </a><?php
                                                                                                                                                        }
                                                                                                                                                            ?>
                        <a href="<?= ROOT ?>/admin/delete_user&idUser=<?php echo $user["idUser"] ?>" class="btn btn-danger me-2 mt-1 sup"> Delete </a>
                    </span>
                </li>
            <?php
                                                                }
            ?>
        </ol>
    <?php
    }

    public function show_vehicles_management($vehicles, $brands)
    { ?>
        <!-- Vehicles table -->
        <div class="container mt-5">
            <h2>Vehicles</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>IdVehicle</th>
                        <th>Name</th>
                        <th>Year</th>
                        <th>Dimensions</th>
                        <th>Consumption</th>
                        <th>Engine</th>
                        <th>Performance</th>
                        <th>Note</th>
                        <th>Version</th>
                        <th>Model</th>
                        <th>Brand</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($vehicles as $vehicle) { ?>
                        <tr>
                            <td><?= $vehicle['idVehicle'] ?></td>
                            <td><?= $vehicle['name'] ?></td>
                            <td><?= $vehicle['year'] ?></td>
                            <td><?= $vehicle['dimensions'] ?></td>
                            <td><?= $vehicle['consumption'] ?></td>
                            <td><?= $vehicle['engine'] ?></td>
                            <td><?= $vehicle['performance'] ?></td>
                            <td><?= $vehicle['note'] ?></td>
                            <td><?= $vehicle['version']['valueVersion'] ?></td>
                            <td><?= $vehicle['modele']['nameModele'] ?></td>
                            <td><?= $vehicle['marque']['nameMarque'] ?></td>
                            <td>
                                <a href="<?= ROOT ?>/admin/show_vehicle_details&idVehicle=<?= $vehicle['idVehicle'] ?>" class="btn btn-success btn-sm">details</a>
                                <a href="<?= ROOT ?>/admin/edit_vehicle_page&idVehicle=<?= $vehicle['idVehicle'] ?>" class="btn btn-primary btn-sm">Edit</a>
                                <a href="<?= ROOT ?>/admin/delete_vehicle&idVehicle=<?= $vehicle['idVehicle'] ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php }
                    ?>
                </tbody>
            </table>
            <a href="<?= ROOT ?>/admin/add_vehicle_page" class="btn btn-primary btn-sm">Add vehicle</a>
        </div>
        <!-- Brands table -->
        <div class="container mt-5 mb-5">
            <h2>Vehicles Brands</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>IdBrand</th>
                        <th>Name</th>
                        <th>Headquarters</th>
                        <th>CEO</th>
                        <th>Founding year</th>
                        <th>Website</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    foreach ($brands as $brand) { ?>
                        <tr>
                            <td><?= $brand['idMarque'] ?></td>
                            <td><?= $brand['nameMarque'] ?></td>
                            <td><?= $brand['headquarters'] ?></td>
                            <td><?= $brand['CEO'] ?></td>
                            <td><?= $brand['founding_year'] ?></td>
                            <td> <a href="<?= $brand['website'] ?>" target="_blank" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Visit <?= $brand['nameMarque'] ?>.com</a></td>
                            <td>
                                <a href="<?= ROOT ?>/admin/show_brand_details&idMarque=<?= $brand['idMarque'] ?>" class="btn btn-success btn-sm">Details</a>
                                <a href="<?= ROOT ?>/admin/edit_brand_page&idMarque=<?= $brand['idMarque'] ?>" class="btn btn-primary btn-sm">Edit</a>
                                <a href="<?= ROOT ?>/admin/delete_brand&idMarque=<?= $brand['idMarque'] ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php }
                    ?>

                </tbody>
            </table>
            <a href="<?= ROOT ?>/admin/add_brand_page" class="btn btn-primary btn-sm">Add brand</a>
        </div>

    <?php }

    public function add_vehicle_form()
    { ?>
        <div class="container mt-5">
            <h2>Add Vehicle</h2>
            <form method="POST" action="<?= ROOT ?>/admin/add_vehicle">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="year">Year:</label>
                    <input type="text" class="form-control" id="year" name="year" required>
                </div>
                <div class="form-group">
                    <label for="dimensions">Dimensions:</label>
                    <input type="text" class="form-control" id="dimensions" name="dimensions" required>
                </div>
                <div class="form-group">
                    <label for="consumption">Consumption:</label>
                    <input type="text" class="form-control" id="consumption" name="consumption" required>
                </div>
                <div class="form-group">
                    <label for="engine">Engine:</label>
                    <input type="text" class="form-control" id="engine" name="engine" required>
                </div>
                <div class="form-group">
                    <label for="performance">Performance:</label>
                    <input type="text" class="form-control" id="performance" name="performance" required>
                </div>
                <div class="form-group">
                    <label for="note">Note:</label>
                    <input type="text" class="form-control" id="note" name="note" required>
                </div>
                <div class="form-group">
                    <label for="idVersion">Version ID:</label>
                    <input type="text" class="form-control" id="idVersion" name="idVersion" required>
                </div>
                <button type="submit" class="btn btn-primary mt-4">Add Vehicle</button>
            </form>
        </div>
    <?php }
    public function edit_vehicle_form($vehicleOldValues)
    { ?>
        <div class="container mt-5">
            <h2>Edit Vehicle</h2>
            <form method="POST" action="<?= ROOT ?>/admin/edit_vehicle&idVehicle=<?= $vehicleOldValues['idVehicle'] ?>">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?= $vehicleOldValues['name'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="year">Year:</label>
                    <input type="text" class="form-control" id="year" name="year" value="<?= $vehicleOldValues['year'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="dimensions">Dimensions:</label>
                    <input type="text" class="form-control" id="dimensions" name="dimensions" value="<?= $vehicleOldValues['dimensions'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="consumption">Consumption:</label>
                    <input type="text" class="form-control" id="consumption" name="consumption" value="<?= $vehicleOldValues['consumption'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="engine">Engine:</label>
                    <input type="text" class="form-control" id="engine" name="engine" value="<?= $vehicleOldValues['engine'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="performance">Performance:</label>
                    <input type="text" class="form-control" id="performance" name="performance" value="<?= $vehicleOldValues['performance'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="note">Note:</label>
                    <input type="text" class="form-control" id="note" name="note" value="<?= $vehicleOldValues['note'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="idVersion">Version ID:</label>
                    <input type="text" class="form-control" id="idVersion" name="idVersion" value="<?= $vehicleOldValues['idVersion'] ?>" required>
                </div>
                <button type="submit" class="btn btn-primary mt-4">Edit Vehicle</button>
            </form>
        </div>
    <?php }

    public function add_brand_form()
    { ?>
        <div class="container mt-5">
            <h2>Add Brand</h2>
            <form method="post" action="<?= ROOT ?>/admin/add_brand">
                <div class="form-group">
                    <label for="nameMarque">Name:</label>
                    <input type="text" class="form-control" id="nameMarque" name="nameMarque" required>
                </div>
                <div class="form-group">
                    <label for="website">Website:</label>
                    <input type="text" class="form-control" id="website" name="website" required>
                </div>
                <div class="form-group">
                    <label for="headquarters">Headquarters:</label>
                    <input type="text" class="form-control" id="headquarters" name="headquarters" required>
                </div>
                <div class="form-group">
                    <label for="CEO">CEO:</label>
                    <input type="text" class="form-control" id="CEO" name="CEO" required>
                </div>
                <div class="form-group">
                    <label for="founding_year">Founding Year:</label>
                    <input type="text" class="form-control" id="founding_year" name="founding_year" required>
                </div>
                <button type="submit" class="btn btn-primary mt-4">Add Brand</button>
            </form>
        </div>
    <?php }
    public function edit_brand_form($brandOldValues)
    { ?>
        <div class="container mt-5">
            <h2>Edit Brand</h2>
            <form method="POST" action="<?= ROOT ?>/admin/edit_brand&idMarque=<?= $brandOldValues['idMarque'] ?>">
                <div class="form-group">
                    <label for="nameMarque">Name:</label>
                    <input type="text" class="form-control" id="nameMarque" name="nameMarque" value="<?= $brandOldValues['nameMarque'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="website">Website:</label>
                    <input type="text" class="form-control" id="website" name="website" value="<?= $brandOldValues['website'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="headquarters">Headquarters:</label>
                    <input type="text" class="form-control" id="headquarters" name="headquarters" value="<?= $brandOldValues['headquarters'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="CEO">CEO:</label>
                    <input type="text" class="form-control" id="CEO" name="CEO" value="<?= $brandOldValues['CEO'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="founding_year">Founding Year:</label>
                    <input type="text" class="form-control" id="founding_year" name="founding_year" value="<?= $brandOldValues['founding_year'] ?>" required>
                </div>
                <button type="submit" class="btn btn-primary mt-4">Edit Brand</button>
            </form>
        </div>
<?php }
}
