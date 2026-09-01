<?php

declare(strict_types=1);

namespace DiamondsNetwork\MenuCardBundle\Dca;

use Contao\DataContainer;
use Contao\System;

/**
 * Central source of truth for the languages editable in the backend, driven by
 * the `menu_card.languages` container parameter — adding a language is a config
 * change, not a DCA/schema change.
 */
class LanguageOptions
{
    public static function get(DataContainer $dc): array
    {
        return System::getContainer()->getParameter('menu_card.languages');
    }
}
