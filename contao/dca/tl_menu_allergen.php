<?php

declare(strict_types=1);

use Contao\DataContainer;
use Contao\DC_Table;

$GLOBALS['TL_DCA']['tl_menu_allergen'] = [
    'config' => [
        'dataContainer'    => DC_Table::class,
        'ctable'           => ['tl_menu_allergen_translation'],
        'switchToEdit'     => true,
        'enableVersioning' => true,
        'markAsCopy'       => 'code',
        'sql'              => [
            'keys' => [
                'id' => 'primary',
            ],
        ],
    ],

    'list' => [
        'sorting' => [
            'mode'               => DataContainer::MODE_SORTED,
            'fields'             => ['code'],
            'flag'               => DataContainer::SORT_ASC,
            'panelLayout'        => 'search,limit',
            'defaultSearchField' => 'code',
        ],
        'label' => [
            'fields' => ['code'],
            'format' => '%s',
        ],
        'operations' => [
            'edit' => [
                'href' => 'act=edit',
                'icon' => 'edit.svg',
            ],
            'translations' => [
                'href'       => 'table=tl_menu_allergen_translation',
                'icon'       => 'theme_plus.svg',
                'attributes' => 'title="Übersetzungen"',
            ],
            'copy' => [
                'href' => 'act=copy',
                'icon' => 'copy.svg',
            ],
            'delete' => [
                'href'       => 'act=delete',
                'icon'       => 'delete.svg',
                'attributes' => 'onclick="if(!confirm(Contao.lang.confirmDelete))return false;Backend.getScrollOffset()"',
            ],
            'show' => [
                'href' => 'act=show',
                'icon' => 'show.svg',
            ],
        ],
    ],

    'palettes' => [
        'default' => '{code_legend},code',
    ],

    'fields' => [
        'id' => [
            'sql' => ['type' => 'integer', 'unsigned' => true, 'autoincrement' => true],
        ],
        'tstamp' => [
            'sql' => ['type' => 'integer', 'unsigned' => true, 'default' => 0],
        ],
        'code' => [
            'search'    => true,
            'inputType' => 'text',
            'eval'      => ['mandatory' => true, 'maxlength' => 8, 'unique' => true, 'tl_class' => 'w50'],
            'sql'       => ['type' => 'string', 'length' => 8, 'default' => ''],
        ],
    ],
];
