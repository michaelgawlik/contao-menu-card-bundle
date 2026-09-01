<?php

declare(strict_types=1);

namespace DiamondsNetwork\MenuCardBundle\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use DiamondsNetwork\MenuCardBundle\MenuCardBundle;

class Plugin implements BundlePluginInterface
{
    public function getBundles(ParserInterface $parser): array
    {
        return [
            BundleConfig::create(MenuCardBundle::class)
                ->setLoadAfter([ContaoCoreBundle::class]),
        ];
    }
}
