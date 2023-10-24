<?php

declare(strict_types=1);

namespace App\Interfaces;
/**
 * Adapter class to change source format to desired format
 */
interface ApiDTOInterface
{
    /**
     * Change format of a movie
     * @param object $sourceData
     * @return object
     */
    public function parseMovie(array $sourceData): object;
}