<?php

declare(strict_types=1);

$menuGroup = [
    'menu_card' => [
        'tables' => [
            'tl_menu_card',
            'tl_menu_card_translation',
            'tl_menu_category',
            'tl_menu_category_translation',
            'tl_menu_item',
            'tl_menu_item_translation',
            'tl_menu_item_price',
            'tl_menu_item_price_translation',
        ],
    ],
    'menu_additive' => [
        'tables' => [
            'tl_menu_additive',
            'tl_menu_additive_translation',
        ],
    ],
    'menu_allergen' => [
        'tables' => [
            'tl_menu_allergen',
            'tl_menu_allergen_translation',
        ],
    ],
];

// Insert the "Speisekarten" group between "content" (Inhalte) and "design" (Layout)
$designPosition = array_search('design', array_keys($GLOBALS['BE_MOD']), true);

if (false !== $designPosition) {
    $GLOBALS['BE_MOD'] = array_slice($GLOBALS['BE_MOD'], 0, $designPosition, true)
        + ['menu' => $menuGroup]
        + array_slice($GLOBALS['BE_MOD'], $designPosition, null, true);
} else {
    $GLOBALS['BE_MOD']['menu'] = $menuGroup;
}

// Icon for the "Speisekarten" navigation group (targets .group-menu, see BackendUser::navigation())
$GLOBALS['TL_CSS'][] = 'bundles/menucard/backend.css';
