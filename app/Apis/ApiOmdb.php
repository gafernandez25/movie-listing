<?php

namespace App\Apis;

use App\Exceptions\ApiReadException;
use Exception;

/**
 * Class to make request to OMDb API
 * https://www.omdbapi.com/
 */
class ApiOmdb
{
    private string $key = "fc59da33";
    private string $basePath = "https://www.omdbapi.com/";

    /**
     * Get movies related to a specific category
     * @param string $category
     * @return object[]
     */
    public function getMovies(string $category): array
    {
        try {
            $json = file_get_contents(
                $this->basePath .
                "?s=" . $category .
                "&apiKey=" . $this->key
            );
        } catch (Exception) {
            throw new ApiReadException();
        }
        return json_decode($json, true);
    }
}