<?php

declare(strict_types=1);

use Contao\DataContainer;
use Contao\DC_Table;

$GLOBALS['TL_DCA']['tl_menu_additive'] = [
    'config' => [
        'dataContainer' => DC_Table::class,
        'ctable'         => ['tl_menu_additive_translation'],
        'switchToEdit'   => true,
        'enableVersioning' => true,
        'markAsCopy'     => 'title',
        'sql'            => [
            'keys' => [
                'id' => 'primary',
            ],
        ],
    ],

    'list' => [
        'sorting' => [
            'mode'               => DataContainer::MODE_SORTED,
            'fields'             => ['number'],
            'flag'               => DataContainer::SORT_ASC,
            'disableGrouping'    => true,
            'panelLayout'        => 'search,limit',
            'defaultSearchField' => 'title',
        ],
        'label' => [
            'fields' => ['number', 'title'],
            'format' => '%s — %s',
        ],
        'operations' => [
            'edit' => [
                'href' => 'act=edit',
                'icon' => 'edit.svg',
            ],
            'translations' => [
                'href'       => 'table=tl_menu_additive_translation',
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
            'show' => [
                'href' => 'act=show',
                'icon' => 'show.svg',
            ],
        ],
    ],

    'palettes' => [
        'default' => '{number_legend},number;{title_legend},title,description',
    ],

    'fields' => [
        'id' => [
            'sql' => ['type' => 'integer', 'unsigned' => true, 'autoincrement' => true],
        ],
        'tstamp' => [
            'sql' => ['type' => 'integer', 'unsigned' => true, 'default' => 0],
        ],
        'number' => [
            'search'    => true,
            'inputType' => 'text',
            'eval'      => ['mandatory' => true, 'maxlength' => 16, 'unique' => true, 'tl_class' => 'w50'],
            'sql'       => ['type' => 'string', 'length' => 16, 'default' => ''],
        ],
        'title' => [
            'search'    => true,
            'inputType' => 'text',
            'eval'      => ['mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'],
            'sql'       => ['type' => 'string', 'length' => 255, 'default' => ''],
        ],
        'description' => [
            'search'    => true,
            'inputType' => 'textarea',
            'eval'      => ['tl_class' => 'clr'],
            'sql'       => ['type' => 'text', 'notnull' => false],
        ],
    ],
];
