<?php

namespace App\Services;

use App\Apis\ApiOmdb;
use App\Collections\MovieCollection;
use App\Entities\Movie;
use App\Interfaces\ApiDTOInterface;
use App\Interfaces\MovieRepositoryInterface;

class MovieService
{
    public function __construct(
        private ApiOmdb $api,
        private ApiDTOInterface $apiDTO,
        private MovieRepositoryInterface $movieRepository
    ) {
    }

    /**
     * Updates movie list in storage
     * @param string $category
     * @return MovieCollection
     * @throws \App\Exceptions\ApiReadException
     * @throws \Exceptions\WriteFileException
     */
    public function updateList(string $category): MovieCollection
    {
        //get movies from API
        $apiMovies = $this->api->getMovies($category);

        //Build the collection
        $movieCollection = new MovieCollection();
        foreach ($apiMovies["Search"] as $apiMovie) {
            $movieDto = $this->apiDTO->parseMovie($apiMovie);
            $movieCollection->addMovie(
                new Movie(
                    $movieDto->title,
                    $movieDto->year,
                    $movieDto->id,
                    $movieDto->type,
                    $movieDto->poster,
                )
            );
        }

        //Saves data in storage
        $this->movieRepository->saveCollection($movieCollection, $category);

        return $movieCollection;
    }

    /**
     * Gets movies from a category from storage
     * @param string $category
     * @return MovieCollection
     * @throws \Exceptions\ReadFileException
     */
    public function getCategoryMovies(string $category): MovieCollection
    {
        return $this->buildCollection($this->movieRepository->getCategoryMovies($category));
    }

    /**
     * Search movies based on category, title and year range
     * @param string $category
     * @param string|null $title
     * @param string|null $yearFrom
     * @param string|null $yearUntil
     * @return MovieCollection
     * @throws \Exceptions\ReadFileException
     */
    public function searchMovies(
        string $category,
        ?string $title = null,
        ?string $yearFrom = null,
        ?string $yearUntil = null,
    ): MovieCollection {
        $movies = $this->buildCollection($this->movieRepository->getCategoryMovies($category));

        $filteredMovieCollection = new MovieCollection();

        foreach ($movies as $movie) {
            if ($title && !str_contains(strtolower($movie->getTitle()), strtolower($title))) {
                continue;
            }
            if ($yearFrom && $movie->getYear() < $yearFrom) {
                continue;
            }
            if ($yearUntil && $movie->getYear() > $yearUntil) {
                continue;
            }
            $filteredMovieCollection->addMovie($movie);
        }

        return $filteredMovieCollection;
    }


    /**
     * Sort a movie collection with parameter and sort direction received for each parameter
     *
     * Direction has to be 1 for ASC and 0 for DESC
     * @param array $sortParams [param => 1|0, param => 1|0]
     * @return MovieCollection
     */
    public function sort(MovieCollection $movies, array $sortParams): MovieCollection
    {
        $data = $movies->getMovies();

        foreach ($data as $key => $movie) {
            $title[$key] = $movie->getTitle();
            $year[$key] = $movie->getYear();
        }

        $multiSort = [];
        foreach ($sortParams as $name => $direction) {
            $multiSort[] = [
                "column" => ${$name},
                "sort" => ($direction) ? SORT_ASC : SORT_DESC
            ];
        }

        if (isset($multiSort[1])) { //two sort parameters
            array_multisort(
                $multiSort[0]["column"],
                $multiSort[0]["sort"],
                $multiSort[1]["column"],
                $multiSort[1]["sort"],
                $data
            );
        } else {    //one sort parameter
            array_multisort(
                $multiSort[0]["column"],
                $multiSort[0]["sort"],
                $data
            );
        }

        return (new MovieCollection())->setMovies($data);
    }

    /** ****************************************************************************/
    /** ****************************************************************************/
    /** ****************************************************************************/

    /**
     * Builds Collection with associative array
     * @param array $movies
     * @return MovieCollection
     */
    private function buildCollection(array $movies)
    {
        $movieCollection = new MovieCollection();
        foreach ($movies as $movie) {
            $movieCollection->addMovie(
                new Movie(
                    $movie["title"],
                    $movie["year"],
                    $movie["id"],
                    $movie["type"],
                    $movie["poster"],
                )
            );
        }

        return $movieCollection;
    }

}