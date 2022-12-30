<?php

namespace App\Models;

class CategoryInfo
{
    public string $code;
    public string $name;
    public float $percentage;
    public float $amount;
    public string $icon;

    /**
     * @param string $code
     * @param string $name
     * @param int $count
     */
    public function __construct(string $code, string $name,string $icon)
    {
        $this->code = $code;
        $this->name = $name;
        $this->icon = $icon;
    }
}
