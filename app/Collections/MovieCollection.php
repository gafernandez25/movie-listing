<?php

namespace App\Collections;

use App\Entities\Movie;
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

    /**
     * @param array $movies
     * @return MovieCollection
     */
    public function setMovies(array $movies): self
    {
        $this->movies = $movies;

        return $this;
    }


}