<?php

namespace App\Models;

class CategoryInfo
{
    public string $code;
    public string $name;
    public int $count;
    public float $percentage;

    /**
     * @param string $code
     * @param string $name
     * @param int $count
     */
    public function __construct(string $code, string $name, int $count)
    {
        $this->code = $code;
        $this->name = $name;
        $this->count = $count;
    }
}
