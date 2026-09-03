<?php

declare(strict_types=1);

namespace DiamondsNetwork\MenuCardBundle\Dca;

use Contao\Database;
use Contao\StringUtil;

/**
 * Renders one item row in the backend list: title (with additive/allergen
 * markers as superscript), all price variants on one line, description below
 * — instead of the bare default label.
 */
class ItemChildRecordRenderer
{
    public static function render(array $row): string
    {
        $title = self::escape((string) ($row['title'] ?? ''));
        $description = trim((string) ($row['description'] ?? ''));
        $markers = self::loadMarkers($row);
        $prices = self::loadPrices((int) $row['id']);

        $html = '<div class="tl_content_left"><strong>'.$title.'</strong>';

        if ($markers !== '') {
            $html .= '<sup>'.self::escape($markers).'</sup>';
        }

        if ($prices !== '') {
            $html .= '<br>'.$prices;
        }

        if ($description !== '') {
            $html .= '<br><small>'.self::escape($description).'</small>';
        }

        return $html.'</div>';
    }

    private static function loadMarkers(array $row): string
    {
        $additiveIds = StringUtil::deserialize($row['additives'] ?? null, true);
        $allergenIds = StringUtil::deserialize($row['allergens'] ?? null, true);

        $markers = [
            ...self::loadColumn('tl_menu_additive', 'number', array_filter(array_map('intval', $additiveIds))),
            ...self::loadColumn('tl_menu_allergen', 'code', array_filter(array_map('intval', $allergenIds))),
        ];

        return implode(',', $markers);
    }

    private static function loadColumn(string $table, string $column, array $ids): array
    {
        if (!$ids) {
            return [];
        }

        $placeholders = implode(',', array_fill(0, \count($ids), '?'));

        $result = Database::getInstance()
            ->prepare("SELECT $column FROM $table WHERE id IN ($placeholders) ORDER BY $column ASC")
            ->execute(...$ids);

        $values = [];

        while ($result->next()) {
            $values[] = (string) $result->$column;
        }

        return $values;
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
