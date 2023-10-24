<?php

declare(strict_types=1);

namespace App\Sorters;

use App\Interfaces\MoviesSortableInterface;

class MoviesSortable
{
    /**
     * Available classes to sort movies arrays based on number of fields to sort by
     * @var MoviesSortableInterface[]
     */
    private array $sortClassesNFields;

    public function __construct()
    {
        $this->sortClassesNFields = [
            new SortMovies1Param(),
            new SortMovies2Param()
        ];
    }

    public function getInstance(int $fieldsQuantity): MoviesSortableInterface
    {
        return $this->sortClassesNFields[$fieldsQuantity - 1];
    }
}