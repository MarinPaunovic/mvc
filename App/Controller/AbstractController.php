<?php
declare(strict_types=1);

namespace App\Controller;

use App\Core\View;


abstract class AbstractController
{
    protected $View;

    public function __construct()
    {
        $this->View = new View;

    }
}