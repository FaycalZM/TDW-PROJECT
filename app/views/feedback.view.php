<?php
class FeedbackView
{
    use View_admin;

    public function show_vehicles_feedback_management($vehiclesFeedback)
    { ?>
        <!-- Vehicles Feedback Table -->
        <div class="container mt-5">
            <h2>Vehicles Feedbacks</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Id Feedback</th>
                        <th>Comment</th>
                        <th>User</th>
                        <th>Vehicle</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($vehiclesFeedback as $feedback) { ?>
                        <tr>
                            <td><?= $feedback['idAvisVehicle'] ?></td>
                            <td><?= $feedback['avis_text'] ?></td>
                            <td><?= $feedback['user']['email'] ?></td>
                            <td><?= $feedback['vehicle']['name'] ?></td>
                            <td><?= $feedback['is_valid'] ? 'validated' : 'pending' ?></td>
                            <td>
                                <?php
                                if (!$feedback['is_valid']) { ?>
                                    <a href="<?= ROOT ?>/admin/validate_vehicle_feedback&idAvisVehicle=<?= $feedback['idAvisVehicle'] ?>" class="btn btn-success btn-sm">validate comment</a>
                                <?php } else { ?>
                                    <a href="<?= ROOT ?>/admin/invalidate_vehicle_feedback&idAvisVehicle=<?= $feedback['idAvisVehicle'] ?>" class="btn btn-warning btn-sm">Block comment</a>
                                <?php }
                                ?>
                                <a href="<?= ROOT ?>/admin/delete_vehicle_feedback&idAvisVehicle=<?= $feedback['idAvisVehicle'] ?>" class="btn btn-danger btn-sm">Delete</a>
                                <?php
                                if (!$feedback['user']['is_valid']) { ?>
                                    <a href="<?= ROOT ?>/admin/validate_user&idUser=<?= $feedback['user']['idUser'] ?>" class="btn btn-success btn-sm">validate user</a>
                                <?php } else { ?>
                                    <a href="<?= ROOT ?>/admin/invalidate_user&idUser=<?= $feedback['user']['idUser'] ?>" class="btn btn-warning btn-sm">Block user</a>
                                <?php }
                                ?>
                            </td>
                        </tr>
                    <?php }
                    ?>
                </tbody>
            </table>
        </div>
    <?php }


    public function show_brands_feedback_management($brandsFeedback)
    { ?>
        <!-- Brands Feedback Table -->
        <div class="container mt-5">
            <h2>Brands Feedbacks</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Id Feedback</th>
                        <th>Comment</th>
                        <th>User</th>
                        <th>Brand</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($brandsFeedback as $feedback) { ?>
                        <tr>
                            <td><?= $feedback['idAvisMarque'] ?></td>
                            <td><?= $feedback['avis_text'] ?></td>
                            <td><?= $feedback['user']['email'] ?></td>
                            <td><?= $feedback['brand']['nameMarque'] ?></td>
                            <td><?= $feedback['is_valid'] ? 'validated' : 'pending' ?></td>
                            <td>
                                <?php
                                if (!$feedback['is_valid']) { ?>
                                    <a href="<?= ROOT ?>/admin/validate_brand_feedback&idAvisMarque=<?= $feedback['idAvisMarque'] ?>" class="btn btn-success btn-sm">validate comment</a>
                                <?php } else { ?>
                                    <a href="<?= ROOT ?>/admin/invalidate_brand_feedback&idAvisMarque=<?= $feedback['idAvisMarque'] ?>" class="btn btn-warning btn-sm">Block comment</a>
                                <?php }
                                ?>
                                <a href="<?= ROOT ?>/admin/delete_brand_feedback&idAvisMarque=<?= $feedback['idAvisMarque'] ?>" class="btn btn-danger btn-sm">Delete</a>
                                <?php
                                if (!$feedback['user']['is_valid']) { ?>
                                    <a href="<?= ROOT ?>/admin/validate_user&idUser=<?= $feedback['user']['idUser'] ?>" class="btn btn-success btn-sm">validate user</a>
                                <?php } else { ?>
                                    <a href="<?= ROOT ?>/admin/invalidate_user&idUser=<?= $feedback['user']['idUser'] ?>" class="btn btn-warning btn-sm">Block user</a>
                                <?php }
                                ?>
                            </td>
                        </tr>
                    <?php }
                    ?>
                </tbody>
            </table>
        </div>
<?php }
}
