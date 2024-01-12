<?php
class BrandView
{
    use View_admin;

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

    public function brand_details_page($brand, $images)
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

                </div>
            </div>

            <!-- Images Section  -->
            <h2>Brand Images</h2>
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
