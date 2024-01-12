<?php
class VehicleView
{
    use View_admin;

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

    public function vehicle_details_page($vehicle, $images)
    { ?>
        <div class="container details-container mt-5">

            <!-- Details Section -->
            <h2>Vehicle Details</h2>
            <div class="details-section mt-2">
                <div class="details-card">
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Name:</strong>
                        </div>
                        <div class="col-md-8">
                            <?= $vehicle['name'] ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Year:</strong>
                        </div>
                        <div class="col-md-8">
                            <?= $vehicle['year'] ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Dimensions:</strong>
                        </div>
                        <div class="col-md-8">
                            <?= $vehicle['dimensions'] ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Consumption:</strong>
                        </div>
                        <div class="col-md-8">
                            <?= $vehicle['consumption'] ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Engine:</strong>
                        </div>
                        <div class="col-md-8">
                            <?= $vehicle['engine'] ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Performance:</strong>
                        </div>
                        <div class="col-md-8">
                            <?= $vehicle['performance'] ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Note:</strong>
                        </div>
                        <div class="col-md-8">
                            <?= $vehicle['note'] ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Version ID:</strong>
                        </div>
                        <div class="col-md-8">
                            <?= $vehicle['idVersion'] ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Images Section  -->
            <h2>Vehicle Images</h2>
            <div class="images-section">
                <?php
                if ($images) {
                    foreach ($images as $image) { ?>
                        <img src="<?= ROOTIMG . $image['imageURL'] ?>" alt="Vehicle Image" class="vehicle-image">
                    <?php }
                } else { ?>
                    <h5>No available images</h5>
                <?php }
                ?>

            </div>

        </div>

<?php }
}
