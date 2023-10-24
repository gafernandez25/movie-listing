<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Redirect;
use App\Request;
use App\Response;
use App\Services\MovieService;
use App\View;

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

    public function view(): void
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

        //search
        $movies = $this->movieService->searchMovies(
            $params->category ?? null,
            $params->title ?? null,
            $params->yearFrom ?? null,
            $params->yearUntil ?? null,
        );

        //sort
        if (!empty($params->sort)) {
            $movies = $this->movieService->sort($movies, $params->sort);
        }

        $this->response->json($movies->getMovies());
    }
}