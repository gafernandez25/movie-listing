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
     * @throws \App\Exceptions\ApiReadException
     * @throws \Exceptions\WriteFileException
     */
    public function updateList(string $category): void
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
    }

    /**
     * Gets movies from a category from storage
     * @param string $category
     * @return MovieCollection
     * @throws \Exceptions\ReadFileException
     */
    public function getCategoryMovies(string $category): MovieCollection
    {
        $movies = $this->movieRepository->getCategoryMovies($category);

        //Build the collection
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