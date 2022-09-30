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
                            <div class="input-group">
                                <input id="categoryInput" name="category" class="form-control"
                                       placeholder="Category"/>
                                <div class="input-group-append">
                                    <button onclick="updateMovieList()" type="button" class="btn btn-info">
                                        Update Movie List
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <table id="movies" class="table table-striped">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Year</th>
                                <th>Type</th>
                                <th>Poster</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script src="/public/js/movie/index.js"></script>
<?php

require_once dirname(__DIR__, 1) . "/layouts/footer.php";
?>

