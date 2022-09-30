<?php

namespace App\Repositories;

use App\Collections\MovieCollection;
use App\Interfaces\MovieRepositoryInterface;
use Exception;
use Exceptions\ReadFileException;
use Exceptions\WriteFileException;

class MovieJsonRepository implements MovieRepositoryInterface
{
    private string $pathName;

    public function __construct()
    {
        $this->pathName = dirname(__DIR__, 2) . "/storage/json_repository/";
    }

    /**
     * Creates or replaces movies json file with movies in the collection
     * @param MovieCollection $movieCollection
     * @return void
     *
     * Disclaimer:
     *
     * The task is not certain about it, and I don't remember from the meeting if I had to create a json
     * file for each search or append or replace existing movies file.
     *
     * I chose to create and replace a json file for each category searched
     * @throws WriteFileException
     */
    public function saveCollection(MovieCollection $movieCollection, string $category): void
    {
        try {
            file_put_contents($this->pathName . $category . ".json", json_encode($movieCollection->getMovies()));
        } catch (Exception) {
            throw new WriteFileException();
        }
    }

    /**
     * Gets movies from specific category
     * @param string $category
     * @return array
     * @throws ReadFileException
     */
    public function getCategoryMovies(string $category): array
    {
        if (!file_exists($this->pathName . $category . ".json")) {
            return [];
        }
        try {
            $movies = json_decode(file_get_contents($this->pathName . $category . ".json"), true);
        } catch (Exception) {
            throw new ReadFileException();
        }
        return $movies;
    }

}