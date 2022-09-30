<?php

namespace App\Controllers;

use App\Redirect;
use App\Request;
use App\Services\MovieService;
use App\View;
use Exception;

class MovieController
{
    public function __construct(
        private Request $request,
        private Redirect $redirect,
        private MovieService $movieService
    ) {
        if (empty($_SESSION["loggedUser"])) {
            session_destroy();
            $this->redirect->route("/login");
        }
    }

    /**
     * Main view of movie list
     * @return void
     * @throws Exception
     */
    public function index()
    {
        $params = $this->request->getRequest();

        $movies = isset($params->category) ? $this->movieService->getCategoryMovies($params->category) : [];

        return View::make("movie/index", [
            "movies" => $movies,
        ])->render();
    }

    /**
     * Get movies and updates movie list data
     * @return void
     * @throws \App\Exceptions\ApiReadException
     * @throws \Exceptions\WriteFileException
     */
    public function update()
    {
        $params = $this->request->getRequest();

        $movies = $this->movieService->updateList($params->category);

        $this->redirect->route("/movies?category=" . $params->category);
    }
}