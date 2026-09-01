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

    /**
     * Languages selectable in a *_translation table: the default language lives
     * directly on the parent record, so it is excluded here to avoid duplicates.
     */
    public static function getAdditional(DataContainer $dc): array
    {
        $default = System::getContainer()->getParameter('menu_card.default_language');

        return array_values(array_diff(self::get($dc), [$default]));
    }
}
