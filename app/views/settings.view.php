<?php
class SettingsView
{
    use View_admin;

    public function show_settings_page()
    { ?>
        <a href="<?= ROOT ?>/login_admin/logout" class="btn btn-danger " style="margin-left: 1rem; margin-top: 1rem;">Logout</a>
        <div class="categories">
            <a href="<?= ROOT ?>/admin/show_guides_management" style="background-image: url(<?= ROOTIMG . 'guide.jpg'; ?>);">
                Guides Achats
            </a>
            <a href="<?= ROOT ?>/admin/show_contact_management" style="background-image: url(<?= ROOTIMG . 'contact.jpg'; ?>);">
                Contact
            </a>
            <a href="<?= ROOT ?>/admin/show_diaporama_management" style="background-image: url(<?= ROOTIMG . 'diaporama.webp'; ?>); color: white;">
                Diaporama
            </a>
        </div>
    <?php
    }

    public function show_contact_management($contactInfos)
    { ?>
        <!-- Contact table -->
        <div class=" mt-5" style="width: 80%; margin: auto;">
            <h2>Contact Infos</h2>
            <table class="table table-bordered align-middle full-width-table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($contactInfos as $info) { ?>
                        <tr>
                            <td><?= $info['idContact'] ?></td>
                            <td><?= $info['contactEmail'] ?></td>
                            <td><?= $info['contactPhone'] ?></td>


                            <td style="display: flex; flex-direction: column; gap: .5rem; ">
                                <a href="<?= ROOT ?>/admin/edit_contact_page&idContact=<?= $info['idContact'] ?>" class="btn btn-primary btn-sm">Edit</a>
                                <a href="<?= ROOT ?>/admin/delete_contact&idContact=<?= $info['idContact'] ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php }
                    ?>
                </tbody>
            </table>
            <a href="<?= ROOT ?>/admin/add_contact_page" class="btn btn-primary btn-sm">Add Contact Infos</a>
        </div>
    <?php }


    public function add_contact_form()
    { ?>
        <div class="container mt-5">
            <h2>Add contact</h2>
            <form method="post" action="<?= ROOT ?>/admin/add_contact">
                <div class="form-group">
                    <label for="contactEmail">Email:</label>
                    <input type="text" class="form-control" id="contactEmail" name="contactEmail" required>
                </div>
                <div class="form-group">
                    <label for="contactPhone">Phone:</label>
                    <input type="text" class="form-control" id="contactPhone" name="contactPhone" required>
                </div>
                <button type="submit" class="btn btn-primary mt-4">Add contact</button>
            </form>
        </div>
    <?php }
    public function edit_contact_form($contactOldValues)
    { ?>
        <div class="container mt-5">
            <h2>Edit contact</h2>
            <form method="post" action="<?= ROOT ?>/admin/edit_contact&idContact=<?= $contactOldValues['idContact'] ?>">
                <div class="form-group">
                    <label for="contactEmail">Email:</label>
                    <input type="text" class="form-control" id="contactEmail" name="contactEmail" value="<?= $contactOldValues['contactEmail'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="contactPhone">Phone:</label>
                    <input type="text" class="form-control" id="contactPhone" name="contactPhone" value="<?= $contactOldValues['contactPhone'] ?>" required>
                </div>
                <button type="submit" class="btn btn-primary mt-4">Edit contact</button>
            </form>
        </div>
<?php }
}
