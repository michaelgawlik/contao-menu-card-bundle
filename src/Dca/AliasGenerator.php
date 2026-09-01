<?php

declare(strict_types=1);

namespace DiamondsNetwork\MenuCardBundle\Dca;

use Contao\Database;
use Contao\DataContainer;
use Contao\Input;
use Contao\StringUtil;

/**
 * Standard Contao "generate alias from title if empty, keep it editable, ensure
 * uniqueness" pattern (as used by tl_news, tl_calendar_events, tl_faq, ...).
 */
class AliasGenerator
{
    public static function generate(mixed $value, DataContainer $dc): string
    {
        $value = (string) $value;

        if ($value !== '') {
            return $value;
        }

        $title = (string) (Input::post('title') ?? ($dc->activeRecord->title ?? ''));
        $alias = StringUtil::standardize($title);

        if ($alias === '') {
            $alias = 'karte';
        }

        return self::makeUnique($dc->table, $alias, (int) $dc->id);
    }

    private static function makeUnique(string $table, string $alias, int $id): string
    {
        $database = Database::getInstance();
        $base = $alias;
        $count = 1;

        while (true) {
            $result = $database
                ->prepare("SELECT id FROM $table WHERE alias = ? AND id != ?")
                ->execute($alias, $id);

            if ($result->numRows < 1) {
                return $alias;
            }

            $alias = $base.'-'.$count++;
        }
    }
}
