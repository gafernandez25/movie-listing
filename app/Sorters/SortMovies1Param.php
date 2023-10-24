<?php

declare(strict_types=1);

namespace App\Sorters;

use App\Interfaces\MoviesSortableInterface;

class SortMovies1Param implements MoviesSortableInterface
{

    /**
     * Sort a Movie objects array based in parameters and sort direction of each
     * one of them received in $sortingParams
     * @param Movie[] $movies
     * @param array $multiSort [["column"=>paramName,"sort"=>SORT_ASC|SORT_DESC]]
     * @return array
     */
    public function sort(array $movies, array $multiSort): array
    {
        array_multisort(
            $multiSort[0]["column"],
            $multiSort[0]["sort"],
            $movies
        );

        return $movies;
    }
}