<?php

namespace App\Collections;

use App\Entities\Movie;
use Exception;
use JetBrains\PhpStorm\Internal\TentativeType;
use Traversable;

class MovieCollection implements \IteratorAggregate
{
    /**
     * List of movies
     * @var array
     */
    private array $movies = [];

    public function getIterator(): Traversable
    {
        return new \ArrayIterator($this->movies);
    }

    /**
     * Add movie to list
     * @param Movie $movie
     * @return MovieCollection
     */
    public function addMovie(Movie $movie): self
    {
        $this->movies[] = $movie;

        return $this;
    }

    /**
     * @return array
     */
    public function getMovies(): array
    {
        return $this->movies;
    }
}