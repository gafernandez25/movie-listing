<?php

namespace App\Interfaces;

/**
 * Class with methods to sort arrays
 */
interface MoviesSortableInterface
{
    /**
     * Sort an array based in parameters and sort direction of each one of them received in $sortingParams
     * @param Movie[] $movies
     * @param array $sortingParams  [param1 => 1|0, param2 => 1|0, ...]
     * @return array
     */
    public function sort(array $movies, array $sortingParams): array;
}