<?php

class HomepageView
{
    use View;


    public function show_diaporama($diaporama = [])
    { ?>
        <div class="slider">
            <div class="diaporama">
                <?php foreach ($diaporama as $item) : ?>
                    <div class="slide">
                        <img src="<?= ROOTIMG  ?><?= $item['image'] ?>" alt="diaporama image" width="100%" height="400px">
                        <a href="<?= $item['URL'] ?>"><button> Read More </button></a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php
    }

    public function show_brands_logos($brands, $showBrandsNames = false)
    { ?>
        <div class="container mt-5">
            <div class="row">
                <?php
                foreach ($brands as $brand) { ?>
                    <div class="col-md-4 mb-4">
                        <a href="<?= ROOT ?>/brands/show_brand_details&idMarque=<?= $brand['idMarque'] ?>" class="brand-logo-link">
                            <img src="<?= ROOTIMG ?><?= $brand['logo'] ?>" alt="Brand Logo" class="img-fluid">
                        </a>
                        <?php
                        if ($showBrandsNames) { ?>
                            <h3 class="brand-name text-center mt-3"><?= $brand['nameMarque'] ?></h3>
                        <?php }
                        ?>
                    </div>
                <?php }
                ?>
            </div>
        </div>
    <?php }

    public function show_feedback_brands_logos($brands)
    { ?>
        <div class="container mt-5">
            <div class="row">
                <?php
                foreach ($brands as $brand) { ?>
                    <div class="col-md-4 mb-4">
                        <a href="<?= ROOT ?>/feedback/show_brand_feedback&idMarque=<?= $brand['idMarque'] ?>" class="brand-logo-link">
                            <img src="<?= ROOTIMG ?><?= $brand['logo'] ?>" alt="Brand Logo" class="img-fluid">
                        </a>
                        <h3 class="brand-name text-center mt-3"><?= $brand['nameMarque'] ?></h3>
                    </div>
                <?php }
                ?>
            </div>
        </div>
    <?php }

    // Brand details page

    public function brand_details_page($brand, $images, $vehicles, $feedbacks)
    { ?>
        <div class="container details-container mt-5">
            <!-- Details Section -->
            <h2>Brand Details</h2>
            <div class="details-section mt-2">
                <div class="details-card">
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Name:</strong>
                        </div>
                        <div class="col-md-8">
                            <?= $brand['nameMarque'] ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Website:</strong>
                        </div>
                        <div class="col-md-8">
                            <a href="<?= $brand['website'] ?>" target="_blank" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                                <?= $brand['nameMarque'] ?> Official Website</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Headquarters:</strong>
                        </div>
                        <div class="col-md-8">
                            <?= $brand['headquarters'] ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <strong>CEO:</strong>
                        </div>
                        <div class="col-md-8">
                            <?= $brand['CEO'] ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Founding Year:</strong>
                        </div>
                        <div class="col-md-8">
                            <?= $brand['founding_year'] ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Note:</strong>
                        </div>
                        <div class="col-md-8">
                            <?= $brand['note'] ?>
                        </div>
                    </div>

                </div>
            </div>
            <!-- Images Section  -->
            <h2 class="mt-5">Brand Images</h2>
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

            <!-- main brand vehicles -->
            <div class="container mt-5">
                <h2 class="mb-4 text-center"> Main <?= $brand['nameMarque'] ?> vehicles </h2>
                <div class="row">
                    <?php
                    foreach (array_slice($vehicles, 0, 3) as $vehicle) { ?>
                        <div class="col-md-4 mb-4">
                            <a href="<?= ROOT ?>/brands/show_vehicle_details&idVehicle=<?= $vehicle['idVehicle'] ?>" class="vehicle-link">
                                <img src="<?= ROOTIMG ?><?= $vehicle['image'] ?>" alt="Brand Logo" class="img-fluid">
                            </a>
                            <h3 class="brand-name text-center mt-3"><?= $vehicle['name'] ?></h3>
                        </div>
                    <?php }
                    ?>
                </div>
            </div>
            <!-- all brand vehicles -->
            <h2 class="mb-3"> All <?= $brand['nameMarque'] ?> vehicles </h2>
            <form method="POST" action="<?= ROOT ?>/brands/vehicle_details">
                <select name="idVehicle" class="form-select" aria-label="Default select example">
                    <option selected>select vehicle</option>
                    <?php
                    foreach ($vehicles as $vehicle) { ?>
                        <option value="<?= $vehicle['idVehicle'] ?>"><?= $vehicle['name'] ?></option>
                    <?php  }
                    ?>
                </select>
                <button type="submit" class="btn btn-primary mt-4">Show Details</button>
            </form>

            <!-- Brand rating form  -->
            <?php
            if (isset($_SESSION['id'])) { ?>
                <div class="container mt-5">
                    <h2>Rate this brand</h2>
                    <form method="post" action="<?= ROOT ?>/brands/rate_brand&idMarque=<?= $brand['idMarque'] ?>">
                        <div class="form-group">
                            <label for="note_value">Rating:</label>
                            <input type="text" class="form-control" id="note_value" name="note_value" required>
                        </div>
                        <button type="submit" class="btn btn-primary mt-4">Rate Brand</button>
                    </form>
                </div>
            <?php   }
            ?>

            <!-- Brand Feedback form -->
            <?php
            if (isset($_SESSION['id'])) { ?>
                <div class="container mt-5">
                    <h2>What do you think about this brand?</h2>
                    <form method="post" action="<?= ROOT ?>/brands/feedback_brand&idMarque=<?= $brand['idMarque'] ?>">
                        <div class="form-group">
                            <label for="avis_text">Your feedback:</label>
                            <input type="text" class="form-control" id="avis_text" name="avis_text" required>
                        </div>
                        <button type="submit" class="btn btn-primary mt-4">Submit</button>
                    </form>
                </div>
            <?php
            }
            $this->feedback_section($feedbacks, '/feedback/like_brand_comment&idAvisMarque=', 'idAvisMarque', 'idMarque');
            ?>




        </div>
    <?php }

    // brand feedback page

    public function brand_feedback_page($brand, $image, $vehicles, $feedbacks)
    { ?>
        <div class="container details-container mt-5">
            <!-- Details Section -->
            <h2>Brand Details</h2>
            <div class="details-section mt-2">
                <div class="details-card">
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Name:</strong>
                        </div>
                        <div class="col-md-8">
                            <?= $brand['nameMarque'] ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Website:</strong>
                        </div>
                        <div class="col-md-8">
                            <a href="<?= $brand['website'] ?>" target="_blank" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                                <?= $brand['nameMarque'] ?> Official Website</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Headquarters:</strong>
                        </div>
                        <div class="col-md-8">
                            <?= $brand['headquarters'] ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <strong>CEO:</strong>
                        </div>
                        <div class="col-md-8">
                            <?= $brand['CEO'] ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Founding Year:</strong>
                        </div>
                        <div class="col-md-8">
                            <?= $brand['founding_year'] ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Note:</strong>
                        </div>
                        <div class="col-md-8">
                            <?= $brand['note'] ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Image Section  -->
            <div class="images-section">
                <img src="<?= ROOTIMG . $image['imageURL'] ?>" alt="Vehicle Image" class="vehicle-image">
            </div>

            <!-- main brand vehicles -->
            <div class="container mt-5">
                <h2 class="mb-4 text-center"> Main <?= $brand['nameMarque'] ?> vehicles </h2>
                <div class="row">
                    <?php
                    foreach (array_slice($vehicles, 0, 3) as $vehicle) { ?>
                        <div class="col-md-4 mb-4">
                            <a href="<?= ROOT ?>/feedback/show_vehicle_feedback&idVehicle=<?= $vehicle['idVehicle'] ?>" class="vehicle-link">
                                <img src="<?= ROOTIMG ?><?= $vehicle['image'] ?>" alt="Brand Logo" class="img-fluid">
                            </a>
                            <h3 class="brand-name text-center mt-3"><?= $vehicle['name'] ?></h3>
                        </div>
                    <?php }
                    ?>
                </div>
            </div>
            <!-- all brand vehicles -->
            <h2 class="mb-3"> All <?= $brand['nameMarque'] ?> vehicles </h2>
            <form method="POST" action="<?= ROOT ?>/feedback/vehicle_feedback">
                <select name="idVehicle" class="form-select" aria-label="Default select example">
                    <option selected>select vehicle</option>
                    <?php
                    foreach ($vehicles as $vehicle) { ?>
                        <option value="<?= $vehicle['idVehicle'] ?>"><?= $vehicle['name'] ?></option>
                    <?php  }
                    ?>
                </select>
                <button type="submit" class="btn btn-primary mt-4">Show Vehicle Feedback</button>
            </form>

            <?php
            $this->feedback_section($feedbacks, '/feedback/like_brand_comment&idAvisMarque=', 'idAvisMarque', 'idMarque');
            ?>
        </div>
    <?php }


    // vehicle details page
    public function vehicle_details_page($vehicle, $images, $feedbacks, $isFavorite)
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
                            <strong>Version:</strong>
                        </div>
                        <div class="col-md-8">
                            <?= $vehicle['version']['valueVersion'] ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Model:</strong>
                        </div>
                        <div class="col-md-8">
                            <?= $vehicle['modele']['nameModele'] ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Brand:</strong>
                        </div>
                        <div class="col-md-8">
                            <?= $vehicle['marque']['nameMarque'] ?>
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
                </div>
            </div>
            <?php
            if (isset($_SESSION['id'])) { ?>
                <a href="<?= ROOT ?>/user/<?= $isFavorite ? 'remove_favorite_vehicle' : 'add_favorite_vehicle' ?>&idUser=<?= $_SESSION['id'] ?>&idVehicle=<?= $vehicle['idVehicle'] ?>" class="btn btn-<?= $isFavorite ? 'danger' : 'success' ?>">
                    <?= $isFavorite ? 'Remove favorite' : 'Add favorite' ?>
                </a>
            <?php }
            ?>


            <!-- Images Section  -->
            <h2 class="mt-5">Vehicle Images</h2>
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

            <!-- Vehicle rating form  -->
            <?php
            if (isset($_SESSION['id'])) { ?>
                <div class="container mt-5">
                    <h2>Rate this vehicle</h2>
                    <form method="post" action="<?= ROOT ?>/brands/rate_vehicle&idVehicle=<?= $vehicle['idVehicle'] ?>">
                        <div class="form-group">
                            <label for="note_value">Rating:</label>
                            <input type="text" class="form-control" id="note_value" name="note_value" required>
                        </div>
                        <button type="submit" class="btn btn-primary mt-4">Rate Vehicle</button>
                    </form>
                </div>
            <?php   }
            ?>

            <!-- Vehicle feedback form  -->
            <?php
            if (isset($_SESSION['id'])) { ?>
                <div class="container mt-5">
                    <h2>What do you think about this vehicle?</h2>
                    <form method="post" action="<?= ROOT ?>/brands/feedback_vehicle&idVehicle=<?= $vehicle['idVehicle'] ?>">
                        <div class="form-group">
                            <label for="avis_text">Your Feedback:</label>
                            <input type="text" class="form-control" id="avis_text" name="avis_text" required>
                        </div>
                        <button type="submit" class="btn btn-primary mt-4">Submit</button>
                    </form>
                </div>
            <?php
            }
            $this->feedback_section($feedbacks, '/feedback/like_vehicle_comment&idAvisVehicle=', 'idAvisVehicle', 'idVehicle');
            if ($feedbacks) { ?>
                <a href="<?= ROOT ?>/feedback/show_vehicle_feedback&idVehicle=<?= $vehicle['idVehicle'] ?>" class="btn btn-primary">Show all comments</a>
            <?php }
            ?>


        </div>

    <?php }

    // vehicle feedback page
    public function vehicle_feedback_page($vehicle, $image, $feedbacks)
    { ?>
        <div class="container details-container mt-5">

            <!-- Vehicle infos -->
            <h2><?= $vehicle['name'] ?> </h2>
            <!-- Image Section  -->
            <div class="images-section">
                <img src="<?= ROOTIMG . $image ?>" alt="Vehicle Image" class="vehicle-image">
            </div>
            <a href="<?= ROOT ?>/brands/show_vehicle_details&idVehicle=<?= $vehicle['idVehicle'] ?>" class="btn btn-primary">Show Details</a>

            <?php
            $this->feedback_section($feedbacks, '/feedback/like_vehicle_comment&idAvisVehicle=', 'idAvisVehicle', 'idVehicle');
            ?>
        </div>

    <?php }


    public function feedback_section($feedbacks, $path, $feedbackId, $id)
    { ?>
        <!-- Feedback (most appreciated feedbacks) -->
        <hr class="mt-4" style="height: 1px; width: 100%;">
        <h2 class="mb-4 ">Users Feedback</h2>
        <!-- User Comment -->
        <?php
        if ($feedbacks) {
            foreach ($feedbacks as $feedback) { ?>
                <div class="card mb-3" style="width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title"><?= $feedback['user']['firstName'] ?> <?= $feedback['user']['lastName'] ?></h5>
                        <p class="card-text"><?= $feedback['avis_text'] ?></p>
                        <p class="card-text"><small class="text-muted">Likes: <?= $feedback['appreciation'] ?></small></p>
                        <a href="<?= ROOT ?><?= $path ?><?= $feedback[$feedbackId] ?>&<?= $id ?>=<?= $feedback[$id] ?>" class="btn btn-outline-primary">Like</a>
                    </div>
                </div>
            <?php }
        } else { ?>
            <h5>No available users feedback</h5>
        <?php }
    }

    // News page
    public function news_page($allNews = [])
    { ?>
        <div class="container mt-5">
            <h2 class="mb-4">Latest News</h2>
            <?php
            foreach ($allNews as $news) { ?>
                <!-- News Frame -->
                <div class="card mb-4">
                    <img src="<?= ROOTIMG ?><?= $news['image'] ?>" class="card-img-top" style="height: 700px;" alt="News Image">
                    <div class="card-body">
                        <h5 class="card-title" style="font-size: 1.5rem;"><?= $news['title'] ?></h5>
                        <p class="card-text" style="font-size: 1.05rem;"><?= $news['content'] ?></p>
                        <a href="<?= ROOT ?>/news/show_news_details&idNews=<?= $news['idNews'] ?>" class="btn btn-primary">Read More</a>
                    </div>
                </div>
            <?php }
            ?>
        </div>
    <?php }

    public function news_details_page($news)
    { ?>
        <!-- News Images Grid -->
        <div class="container mt-5">
            <h2 class="mb-4">News Details</h2>

            <!-- News Content -->
            <div class="card mb-4">
                <img src="<?= ROOTIMG ?><?= $news['images'][0]['imageURL'] ?>" class="card-img-top" alt="News Main Image">
                <div class="card-body">
                    <h5 class="card-title"><?= $news['title'] ?></h5>
                    <p class="card-text"><?= $news['content'] ?></p>
                    <a href="<?= $news['newsSource'] ?>" class="btn btn-primary">Read More</a>
                </div>
            </div>
            <div class="row">
                <?php
                foreach (array_slice($news['images'], 1, count($news['images']) - 1) as $image) { ?>
                    <div class="col-md-4 mb-4">
                        <img src="<?= ROOTIMG ?><?= $image['imageURL'] ?>" class="img-fluid" alt="News Image">
                    </div>
                <?php }
                ?>
            </div>
            <a href="<?= ROOT ?>/news/show_news_page" class="btn btn-primary">Back to News</a>
        </div>
    <?php }

    // user profile
    public function user_profile_page($user)
    { ?>
        <div class="container mt-5">
            <h1 class="mb-4"><?= $user['firstName'] ?> Profile</h1>
            <!-- User Infos -->
            <div class="card mb-4">
                <div class="card-body">
                    <h3 class="card-title">User Informations</h3>
                    <p class="card-text"><strong>full name:</strong> <?= $user['firstName'] ?> <?= $user['lastName'] ?> </p>
                    <p class="card-text"><strong>Email:</strong> <?= $user['email'] ?></p>
                </div>
            </div>

            <!-- Favorite Vehicles -->
            <div class="card mb-4">
                <div class="card-body">
                    <h3 class="card-title">Favorite Vehicles</h3>
                    <div class="container mt-5">
                        <div class="row">
                            <?php
                            if ($user['favorites']) {
                                foreach ($user['favorites'] as $vehicle) { ?>
                                    <div class="col-md-4 mb-4" style="display: flex; flex-direction: column; align-items: center;">
                                        <a href="<?= ROOT ?>/brands/show_vehicle_details&idVehicle=<?= $vehicle['idVehicle'] ?>" class="vehicle-link">
                                            <img src="<?= ROOTIMG ?><?= $vehicle['image'] ?>" alt="Brand Logo" class="img-fluid">
                                        </a>
                                        <h3 class="brand-name text-center mt-3"><?= $vehicle['vehicle']['name'] ?></h3>
                                        <a href="<?= ROOT ?>/brands/show_vehicle_details&idVehicle=<?= $vehicle['idVehicle'] ?>" class="btn btn-primary mt-2">Show details</a>
                                        <a href="<?= ROOT ?>/user/remove_favorite_vehicle&idUser=<?= $user['idUser'] ?>&idVehicle=<?= $vehicle['idVehicle'] ?>" class="btn btn-danger mt-2">Remove favorite</a>
                                    </div>
                                <?php }
                            } else { ?>
                                <h5>No favorite vehicles</h5>
                            <?php }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Vehicles Ratings -->
            <div class="card mb-4">
                <div class="card-body">
                    <h3 class="card-title">Vehicle Ratings</h3>
                    <?php
                    foreach ($user['vehiclesRating'] as $vehicleRating) { ?>
                        <p><strong><?= $vehicleRating['vehicle']['name'] ?> : </strong> <?= $vehicleRating['note_value'] ?>/5</p>
                    <?php }
                    ?>
                </div>
            </div>

            <!-- User Brands Ratings -->
            <div class="card mb-4">
                <div class="card-body">
                    <h3 class="card-title">Brand Ratings</h3>
                    <?php
                    foreach ($user['brandsRating'] as $brandRating) { ?>
                        <p><strong><?= $brandRating['brand']['nameMarque'] ?> : </strong> <?= $brandRating['note_value'] ?>/5</p>
                    <?php }
                    ?>
                </div>
            </div>

            <!-- User Vehicles Reviews (the pending reviews are not visible to the user) -->
            <div class="card mb-4">
                <div class="card-body">
                    <h3 class="card-title">Vehicles Reviews</h3>
                    <?php
                    foreach ($user['vehiclesFeedback'] as $vehicleFeedback) { ?>
                        <div style="display: flex; justify-content: space-between;">
                            <p><strong>Review :</strong> "<?= $vehicleFeedback['avis_text'] ?>" </p>
                            <p><strong>Vehicle :</strong> <?= $vehicleFeedback['vehicle']['name'] ?> </p>
                        </div>
                    <?php }
                    ?>
                </div>
            </div>

            <!-- User Brands Reviews (the pending reviews are not visible to the user) -->
            <div class="card mb-4">
                <div class="card-body">
                    <h3 class="card-title">Brands Reviews</h3>
                    <?php
                    foreach ($user['brandsFeedback'] as $brandFeedback) { ?>
                        <div style="display: flex; justify-content: space-between;">
                            <p><strong>Review :</strong> "<?= $brandFeedback['avis_text'] ?>" </p>
                            <p><strong>Brand :</strong> <?= $brandFeedback['brand']['nameMarque'] ?> </p>
                        </div>
                    <?php }
                    ?>
                </div>
            </div>
        </div>
<?php }
}
