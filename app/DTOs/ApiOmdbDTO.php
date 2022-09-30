<?php

namespace App\DTOs;

use App\Interfaces\ApiDTOInterface;

/**
 * Adapter class to change source format to desired format
 */
class ApiOmdbDTO implements ApiDTOInterface
{
    /**
     * Change format of a movie
     * @param array $sourceData
     * @return object
     */
    public function parseMovie(array $sourceData): object
    {
        $obj = new \stdClass();

        $obj->title = $sourceData["Title"];
        $obj->year = $sourceData["Year"];
        $obj->id = $sourceData["imdbID"];
        $obj->type = $sourceData["Type"];
        $obj->poster = $sourceData["Poster"];

        return $obj;
    }
}