<?php

declare(strict_types=1);

namespace App;

class View
{
    public function __construct(protected string $view, protected array $params = [])
    {
    }

    public static function make(string $view, array $params = []): static
    {
        return new static($view, $params);
    }

    public function render():void
    {
        $viewPath = VIEW_PATH . "/" . $this->view . ".php";

        if (!file_exists($viewPath)) {
            throw new \Exception("View not found");
        }

        foreach ($this->params as $key => $value) {
            $$key = $value;
        }

        include $viewPath;
    }
}