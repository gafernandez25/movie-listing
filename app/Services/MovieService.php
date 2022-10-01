<?php

namespace App\Services;

use App\Apis\ApiOmdb;
use App\Collections\MovieCollection;
use App\Entities\Movie;
use App\Interfaces\ApiDTOInterface;
use App\Interfaces\MovieRepositoryInterface;
use App\Sorters\MoviesSortable;
use App\Sorters\SortMovies1Param;
use App\Sorters\SortMovies2Param;

class MovieService
{
    public function __construct(
        private ApiOmdb $api,
        private ApiDTOInterface $apiDTO,
        private MovieRepositoryInterface $movieRepository,
        private MoviesSortable $moviesSortable
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
     * @param MovieCollection $movies Collection to be sorted
     * @param string $sortInputParams param1-dir1-param2-dir2-...
     * @return MovieCollection  Sorted collection
     */
    public function sort(MovieCollection $movies, string $sortInputParams): MovieCollection
    {
        //Build an array with parameters and sort direction
        //[param1 => 1|0, param2 => 1|0, ...]
        $sortParamArray = explode("-", $sortInputParams);

        for ($i = 0; $i < count($sortParamArray); $i = $i + 2) {
            if (!isset($sortParams[$sortParamArray[$i]])) {  //avoid usage of repeated parameters
                $sortParams[$sortParamArray[$i]] = $sortParamArray[$i + 1];
            }
        }

        //build array with columns that could be needed to use to sort movies
        foreach ($movies as $key => $movie) {
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

        $data = ($this->moviesSortable->getInstance(count($multiSort)))
            ->sort($movies->getMovies(), $multiSort);

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