<?php

declare(strict_types=1);

use Contao\DataContainer;
use Contao\DC_Table;

$GLOBALS['TL_DCA']['tl_menu_item_price'] = [
    'config' => [
        'dataContainer'    => DC_Table::class,
        'ptable'           => 'tl_menu_item',
        'ctable'           => ['tl_menu_item_price_translation'],
        'switchToEdit'     => true,
        'enableVersioning' => true,
        'markAsCopy'       => 'label',
        'sql'              => [
            'keys' => [
                'id'  => 'primary',
                'pid' => 'index',
            ],
        ],
    ],

    'list' => [
        'sorting' => [
            'mode'        => DataContainer::MODE_PARENT,
            'fields'      => ['sorting'],
            'panelLayout' => 'search,limit',
        ],
        'label' => [
            'fields' => ['label', 'price'],
            'format' => '%s — %s €',
        ],
        'operations' => [
            'edit' => [
                'href' => 'act=edit',
                'icon' => 'edit.svg',
            ],
            'translations' => [
                'href'       => 'table=tl_menu_item_price_translation',
                'icon'       => 'children.svg',
                'attributes' => 'title="Weitere Sprachen"',
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
        ],
    ],

    'palettes' => [
        'default' => '{price_legend},label,price',
    ],

    'fields' => [
        'id' => [
            'sql' => ['type' => 'integer', 'unsigned' => true, 'autoincrement' => true],
        ],
        'tstamp' => [
            'sql' => ['type' => 'integer', 'unsigned' => true, 'default' => 0],
        ],
        'pid' => [
            'sql' => ['type' => 'integer', 'unsigned' => true, 'default' => 0],
        ],
        'sorting' => [
            'sql' => ['type' => 'integer', 'unsigned' => true, 'default' => 0],
        ],
        'label' => [
            'search'    => true,
            'inputType' => 'text',
            'eval'      => ['maxlength' => 64, 'tl_class' => 'w50'],
            'sql'       => ['type' => 'string', 'length' => 64, 'default' => ''],
        ],
        'price' => [
            'inputType' => 'text',
            'eval'      => ['mandatory' => true, 'tl_class' => 'w50'],
            'sql'       => ['type' => 'decimal', 'precision' => 10, 'scale' => 2, 'default' => '0.00'],
        ],
    ],
];
