<?php

declare(strict_types=1);

namespace DiamondsNetwork\MenuCardBundle\Dca;

use Contao\Database;

/**
 * Renders one item row in the backend list: title, all price variants on one
 * line, description below — instead of the bare default label.
 */
class ItemChildRecordRenderer
{
    public static function render(array $row): string
    {
        $title = self::escape((string) ($row['title'] ?? ''));
        $description = trim((string) ($row['description'] ?? ''));
        $prices = self::loadPrices((int) $row['id']);

        $html = '<div class="tl_content_left"><strong>'.$title.'</strong>';

        if ($prices !== '') {
            $html .= '<br>'.$prices;
        }

        if ($description !== '') {
            $html .= '<br><small>'.self::escape($description).'</small>';
        }

        return $html.'</div>';
    }

    private static function loadPrices(int $itemId): string
    {
        $result = Database::getInstance()
            ->prepare('SELECT label, price FROM tl_menu_item_price WHERE pid = ? ORDER BY sorting')
            ->execute($itemId);

        $parts = [];

        while ($result->next()) {
            $price = number_format((float) $result->price, 2, ',', '.').' €';
            $label = trim((string) $result->label);

            $parts[] = self::escape($label !== '' ? $label.': '.$price : $price);
        }

        return implode(' &nbsp;|&nbsp; ', $parts);
    }

    private static function escape(string $value): string
    {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }
}
