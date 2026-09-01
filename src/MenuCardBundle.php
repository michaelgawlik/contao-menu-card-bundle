<?php

declare(strict_types=1);

namespace DiamondsNetwork\MenuCardBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class MenuCardBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
