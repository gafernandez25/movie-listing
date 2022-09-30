<?php

namespace App\Controllers;

use App\Redirect;
use App\Request;
use App\Response;
use App\Services\MovieService;
use App\View;
use Exception;

class MovieController
{
    public function __construct(
        private Request $request,
        private Redirect $redirect,
        private Response $response,
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
    public function index(): void
    {
        View::make("movie/index")->render();
    }

    /**
     * Gets movies and updates movie list data
     * @return void
     * @throws \App\Exceptions\ApiReadException
     * @throws \Exceptions\WriteFileException
     */
    public function update(): void
    {
        $params = $this->request->getRequest();

        $movies = $this->movieService->updateList($params->category);

        $this->response->json($movies->getMovies());
    }

    /**
     * Search movies based on category, title and year range
     * @return void
     * @throws \Exceptions\ReadFileException
     */
    public function search(): void
    {
        $params = $this->request->getRequest();

        $movies = $this->movieService->searchMovies(
            $params->category ?? null,
            $params->title ?? null,
            $params->yearFrom ?? null,
            $params->yearUntil ?? null,
        );

        $this->response->json($movies->getMovies());
    }
}