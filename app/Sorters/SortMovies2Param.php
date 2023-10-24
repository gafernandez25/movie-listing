<?php

declare(strict_types=1);

namespace App\Sorters;

use App\Interfaces\MoviesSortableInterface;

class SortMovies2Param implements MoviesSortableInterface
{

    /**
     * Sort a Movie objects array based in parameters and sort direction of each
     * one of them received in $sortingParams
     * @param Movie[] $movies
     * @param array $multiSort [["column"=>paramName,"sort"=>SORT_ASC|SORT_DESC],["column"=>paramName,"sort"=>SORT_ASC|SORT_DESC]]
     * @return array
     */
    public function sort(array $movies, array $multiSort): array
    {
        array_multisort(
            $multiSort[0]["column"],
            $multiSort[0]["sort"],
            $multiSort[1]["column"],
            $multiSort[1]["sort"],
            $movies
        );

        return $movies;
    }
}