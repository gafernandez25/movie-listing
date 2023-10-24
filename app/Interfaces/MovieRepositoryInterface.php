<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\Collections\MovieCollection;
use Exceptions\ReadFileException;
use Exceptions\WriteFileException;

interface MovieRepositoryInterface
{
    /**
     * Creates or replaces movies json file with movies in the collection
     * @param MovieCollection $movieCollection
     * @return void
     * @throws WriteFileException
     */
    public function saveCollection(MovieCollection $movieCollection, string $category): void;

    /**
     * Gets movies from specific category
     * @param string $category
     * @return array
     * @throws ReadFileException
     */
    public function getCategoryMovies(string $category): array;
}