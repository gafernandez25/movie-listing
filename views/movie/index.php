<?php

require_once dirname(__DIR__, 1) . "/layouts/header.php";
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Movies</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 offset-md-8">
                            <form action="/movies/list/update" method="post">
                                <div class="input-group">
                                    <input id="categoryInput" name="category" class="form-control"
                                           placeholder="Category"/>
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-info">
                                            Update Movie List
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Year</th>
                                <th>Type</th>
                                <th>Poster</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($movies as $movie): ?>
                                <tr>
                                    <td><?= $movie->getTitle() ?></td>
                                    <td><?= $movie->getYear() ?></td>
                                    <td><?= $movie->getType() ?></td>
                                    <td>
                                        <a href="<?= $movie->getPoster() ?>" target="_blank">
                                            <img src="<?= $movie->getPoster() ?>" height="50">
                                        </a>
                                    </td>
                                </tr>
                            <?php
                            endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php

require_once dirname(__DIR__, 1) . "/layouts/footer.php";
?>

