<?php

class ComparatorView
{
    use View;

    // Comparator
    public function show_comparator($brands, $message)
    { ?>
        <form class="container mt-5" action="<?= ROOT ?>/comparator/show_comparison_page" method="post">
            <h2 class="mb-4">Vehicle Comparison</h2>
            <div class="row">
                <!-- display the 4 forms -->
                <?php for ($i = 1; $i <= 4; $i++) { ?>
                    <div class="col-md-3">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title">Vehicle <?= $i ?></h5>
                                <div class="form-group">
                                    <label for="brand<?= $i ?>">Brand:</label>
                                    <select class="form-control form-select brand-select" id="brand<?= $i ?>" name="brand<?= $i ?>">
                                        <?php
                                        foreach ($brands as $brand) { ?>
                                            <option value="<?= $brand['idMarque'] ?>"><?= $brand['nameMarque'] ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="model<?= $i ?>">Model:</label>
                                    <select class="form-control form-select model-select" id="model<?= $i ?>" name="model<?= $i ?>">
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="version<?= $i ?>">Version:</label>
                                    <select class="form-control form-select version-select" id="version<?= $i ?>" name="version<?= $i ?>">
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="vehicle<?= $i ?>">Year:</label>
                                    <select class="form-control form-select vehicle-select" id="vehicle<?= $i ?>" name="vehicle<?= $i ?>">
                                    </select>
                                </div>

                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <?php
            if ($message) { ?>
                <div class='alert alert-danger mt-5 mb-5 w-50 mx-auto' role='alert'> <?= decode_message($message) ?> </div>
            <?php }
            ?>
            <!-- Button to Compare Vehicles -->
            <button type="submit" class="btn btn-primary btn-lg btn-block">Compare Vehicles</button>
        </form>
    <?php }

    public function comparison_table($vehicles)
    { ?>
        <div class="container mt-5">
            <h2>Vehicles Comparison</h2>

            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Vehicle</th>
                            <th>Image</th>
                            <th>Brand</th>
                            <th>Model</th>
                            <th>Version</th>
                            <th>Engine</th>
                            <th>Consumption</th>
                            <th>Performance</th>
                            <th>Dimensions</th>
                            <th>Rating</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($vehicles as $vehicle) { ?>
                            <tr>
                                <td><?= $vehicle['name'] ?> </td>
                                <td>
                                    <a href="<?= ROOT ?>/brands/show_vehicle_details&idVehicle=<?= $vehicle['idVehicle'] ?>"><img src="<?= ROOTIMG ?><?= $vehicle['image'] ?>" alt="Vehicle Image" style="max-width: 300px;"></a>
                                </td>
                                <td><?= $vehicle['brand'] ?> </td>
                                <td><?= $vehicle['model'] ?> </td>
                                <td><?= $vehicle['version'] ?> </td>
                                <td><?= $vehicle['engine'] ?> </td>
                                <td><?= $vehicle['consumption'] ?> </td>
                                <td><?= $vehicle['performance'] ?> </td>
                                <td><?= $vehicle['dimensions'] ?> </td>
                                <td><?= $vehicle['note'] ?>/5</td>
                                <td><?= $vehicle['price'] ?> USD</td>
                            </tr>
                        <?php }
                        ?>
                    </tbody>
                </table>
            </div>

        </div>
    <?php }

    public function most_searched_comparsions($data)
    { ?>
        <div class="container">
            <h2 class="mt-4 mb-4">Popular Vehicle Comparisons</h2>
            <?php
            foreach ($data as $comparison) { ?>
                <div class="row">
                    <p class="mt-4"><strong>Popularity: <?= $comparison['popularity'] ?></strong> </p>
                    <div class="col-md-6">
                        <div class="card comparison-card">
                            <img src="<?= ROOTIMG ?><?= $comparison['vehicle1']['image'] ?>" class="card-img-top" alt="Vehicle 1">
                            <div class="card-body">
                                <h5 class="card-title"><?= $comparison['vehicle1']['name'] ?></h5>
                                <p class="card-text">Brand: <?= $comparison['vehicle1']['brand'] ?></p>
                                <p class="card-text">Model: <?= $comparison['vehicle1']['model'] ?></p>
                                <p class="card-text">Version: <?= $comparison['vehicle1']['version'] ?></p>
                                <a href="<?= ROOT ?>/brands/show_vehicle_details&idVehicle=<?= $comparison['vehicle1']['idVehicle'] ?>" class="btn btn-primary">Show Details</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card comparison-card">
                            <img src="<?= ROOTIMG ?><?= $comparison['vehicle2']['image'] ?>" class="card-img-top" alt="Vehicle 2">
                            <div class="card-body">
                                <h5 class="card-title"><?= $comparison['vehicle2']['name'] ?></h5>
                                <p class="card-text">Brand: <?= $comparison['vehicle2']['brand'] ?></p>
                                <p class="card-text">Model: <?= $comparison['vehicle2']['model'] ?></p>
                                <p class="card-text">Version: <?= $comparison['vehicle2']['version'] ?></p>
                                <a href="<?= ROOT ?>/brands/show_vehicle_details&idVehicle=<?= $comparison['vehicle2']['idVehicle'] ?>" class="btn btn-primary">Show Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }
            ?>


        </div>
<?php }
}
