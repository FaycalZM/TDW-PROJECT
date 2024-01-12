<?php
class NewsView
{
    use View_admin;

    public function show_news_management($news)
    { ?>
        <!-- News table -->
        <div class="container mt-5">
            <h2>News</h2>
            <table class="table table-bordered  align-middle full-width-table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Images</th>
                        <th>Read More</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($news as $new) { ?>
                        <tr>
                            <td><?= $new['idNews'] ?></td>
                            <td><?= $new['title'] ?></td>
                            <td><?= $new['content'] ?></td>
                            <td>
                                <?php
                                foreach ($new['images'] as $image) { ?>
                                    <div style="display: flex; gap: 1.5rem; align-items: center; margin-bottom: .25rem;">
                                        <a href="<?= ROOTIMG ?><?= $image['imageURL'] ?>">Show Image</a>
                                        <a href="<?= ROOT ?>/admin/delete_news_image&idImageNews=<?= $image['idImageNews'] ?>" class="btn btn-danger btn-sm">Delete</a>
                                    </div>
                                <?php }
                                ?>
                            </td>
                            <td><a href="<?= $new['newsSource'] ?>" target="_blank" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                                    Read More</a></td>
                            <td style="display: flex; flex-direction: column; gap: .5rem;">
                                <a href="<?= ROOT ?>/admin/edit_news_page&idNews=<?= $new['idNews'] ?>" class="btn btn-primary btn-sm">Edit</a>
                                <a href="<?= ROOT ?>/admin/add_news_image_page&idNews=<?= $new['idNews'] ?>" class="btn btn-secondary btn-sm">Add image</a>
                                <a href="<?= ROOT ?>/admin/delete_news&idNews=<?= $new['idNews'] ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php }
                    ?>
                </tbody>
            </table>
            <a href="<?= ROOT ?>/admin/add_news_page" class="btn btn-primary btn-sm">Add News</a>
        </div>
    <?php }

    public function add_news_form()
    { ?>
        <div class="container mt-5">
            <h2>Add News</h2>
            <form method="post" action="<?= ROOT ?>/admin/add_news">
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="form-group">
                    <label for="content">Content:</label>
                    <input type="text" class="form-control" id="content" name="content" required>
                </div>
                <div class="form-group">
                    <label for="newsSource">Source:</label>
                    <input type="text" class="form-control" id="newsSource" name="newsSource" required>
                </div>
                <button type="submit" class="btn btn-primary mt-4">Add news</button>
            </form>
        </div>
    <?php }
    public function edit_news_form($newsOldValues)
    { ?>
        <div class="container mt-5">
            <h2>Edit News</h2>
            <form method="POST" action="<?= ROOT ?>/admin/edit_news&idNews=<?= $newsOldValues['idNews'] ?>">
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control" id="title" name="title" value="<?= $newsOldValues['title'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="content">Content:</label>
                    <input type="text" class="form-control" id="content" name="content" value="<?= $newsOldValues['content'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="newsSource">Source:</label>
                    <input type="text" class="form-control" id="newsSource" name="newsSource" value="<?= $newsOldValues['newsSource'] ?>" required>
                </div>
                <button type="submit" class="btn btn-primary mt-4">Edit News</button>
            </form>
        </div>
    <?php }

    public function add_news_image_form($idNews)
    { ?>
        <div class="container mt-5">
            <h2>Add News Image</h2>
            <form method="post" action="<?= ROOT ?>/admin/add_news_image&idNews=<?= $idNews ?>">
                <div class="form-group">
                    <label for="imageURL">URL:</label>
                    <input type="text" class="form-control" id="imageURL" name="imageURL" required>
                </div>

                <button type="submit" class="btn btn-primary mt-4">Add image</button>
            </form>
        </div>
<?php }
}
