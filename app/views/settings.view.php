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
    // Contact management
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
    // guides management
    public function show_guides_management($guides)
    { ?>
        <!-- Guides table -->
        <div class=" mt-5" style="width: 80%; margin: auto;">
            <h2>Guides d'achat</h2>
            <table class="table table-bordered align-middle full-width-table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Category</th>
                        <th>Author</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($guides as $guide) { ?>
                        <tr>
                            <td><?= $guide['idGuide'] ?></td>
                            <td><?= $guide['title'] ?></td>
                            <td><?= $guide['content'] ?></td>
                            <td><?= $guide['category'] ?></td>
                            <td><?= $guide['author'] ?></td>

                            <td style="display: flex; flex-direction: column; gap: .5rem; ">
                                <a href="<?= ROOT ?>/admin/edit_guide_page&idGuide=<?= $guide['idGuide'] ?>" class="btn btn-primary btn-sm">Edit</a>
                                <a href="<?= ROOT ?>/admin/delete_guide&idGuide=<?= $guide['idGuide'] ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php }
                    ?>
                </tbody>
            </table>
            <a href="<?= ROOT ?>/admin/add_guide_page" class="btn btn-primary btn-sm">Add Guide</a>
        </div>
    <?php }


    public function add_guide_form()
    { ?>
        <div class="container mt-5">
            <h2>Add Guide</h2>
            <form method="post" action="<?= ROOT ?>/admin/add_guide">
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="form-group">
                    <label for="content">Content:</label>
                    <input type="text" class="form-control" id="content" name="content" required>
                </div>
                <div class="form-group">
                    <label for="category">Category:</label>
                    <input type="text" class="form-control" id="category" name="category" required>
                </div>
                <div class="form-group">
                    <label for="author">Author:</label>
                    <input type="text" class="form-control" id="author" name="author" required>
                </div>
                <button type="submit" class="btn btn-primary mt-4">Add guide</button>
            </form>
        </div>
    <?php }
    public function edit_guide_form($guideOldValues)
    { ?>
        <div class="container mt-5">
            <h2>Edit guide</h2>
            <form method="post" action="<?= ROOT ?>/admin/edit_guide&idGuide=<?= $guideOldValues['idGuide'] ?>">
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control" id="title" name="title" value="<?= $guideOldValues['title'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="content">Content:</label>
                    <input type="text" class="form-control" id="content" name="content" value="<?= $guideOldValues['content'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="category">Category:</label>
                    <input type="text" class="form-control" id="category" name="category" value="<?= $guideOldValues['category'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="author">Author:</label>
                    <input type="text" class="form-control" id="author" name="author" value="<?= $guideOldValues['author'] ?>" required>
                </div>
                <button type="submit" class="btn btn-primary mt-4">Edit guide</button>
            </form>
        </div>
    <?php }
    // Diaporama management
    public function show_diaporama_management($diaporama)
    { ?>
        <!-- Diaporama table -->
        <div class=" mt-5" style="width: 80%; margin: auto;">
            <h2>Diaporama</h2>
            <table class="table table-bordered align-middle full-width-table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Image</th>
                        <th>URL</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($diaporama as $item) { ?>
                        <tr>
                            <td><?= $item['idDiaporama'] ?></td>
                            <td><?= $item['image'] ?></td>
                            <td><?= $item['URL'] ?></td>

                            <td style="display: flex; flex-direction: column; gap: .5rem; ">
                                <a href="<?= ROOT ?>/admin/edit_diaporama_page&idDiaporama=<?= $item['idDiaporama'] ?>" class="btn btn-primary btn-sm">Edit</a>
                                <a href="<?= ROOT ?>/admin/delete_diaporama&idDiaporama=<?= $item['idDiaporama'] ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php }
                    ?>
                </tbody>
            </table>
            <a href="<?= ROOT ?>/admin/add_diaporama_page" class="btn btn-primary btn-sm">Add Diaporama Item</a>
        </div>
    <?php }

    public function add_diaporama_form()
    { ?>
        <div class="container mt-5">
            <h2>Add Diaporama Item</h2>
            <form method="post" action="<?= ROOT ?>/admin/add_diaporama">
                <div class="form-group">
                    <label for="image">Image:</label>
                    <input type="text" class="form-control" id="image" name="image" required>
                </div>
                <div class="form-group">
                    <label for="URL">URL:</label>
                    <input type="text" class="form-control" id="URL" name="URL" required>
                </div>
                <button type="submit" class="btn btn-primary mt-4">Add Diaporama Item</button>
            </form>
        </div>
    <?php }

    public function edit_diaporama_form($diaporamaOldValues)
    { ?>
        <div class="container mt-5">
            <h2>Edit Diaporama Item</h2>
            <form method="post" action="<?= ROOT ?>/admin/edit_diaporama&idDiaporama=<?= $diaporamaOldValues['idDiaporama'] ?>">
                <div class="form-group">
                    <label for="image">Image:</label>
                    <input type="text" class="form-control" id="image" name="image" value="<?= $diaporamaOldValues['image'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="URL">URL:</label>
                    <input type="text" class="form-control" id="URL" name="URL" value="<?= $diaporamaOldValues['URL'] ?>" required>
                </div>
                <button type="submit" class="btn btn-primary mt-4">Edit Diaporama Item</button>
            </form>
        </div>
<?php }
}
