<?php

namespace App\Sorters;

class MoviesSortable
{
    /**
     * Available classes to sort movies arrays based on number of fields to sort by
     * @var array
     */
    private array $sortClassesNFields;

    public function __construct()
    {
        $this->sortClassesNFields = [
            new SortMovies1Param(),
            new SortMovies2Param()
        ];
    }

    public function getInstance(int $fieldsQuantity)
    {
        return $this->sortClassesNFields[$fieldsQuantity - 1];
    }
}