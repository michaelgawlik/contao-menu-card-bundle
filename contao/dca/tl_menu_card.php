<?php

declare(strict_types=1);

use Contao\DataContainer;
use Contao\DC_Table;

$GLOBALS['TL_DCA']['tl_menu_card'] = [
    'config' => [
        'dataContainer'    => DC_Table::class,
        'ctable'           => ['tl_menu_category', 'tl_menu_card_translation'],
        'switchToEdit'     => true,
        'enableVersioning' => true,
        'markAsCopy'       => 'alias',
        'sql' => [
            'keys' => [
                'id'    => 'primary',
                'alias' => 'unique',
            ],
        ],
    ],

    'list' => [
        'sorting' => [
            'mode'               => DataContainer::MODE_SORTED,
            'fields'             => ['sorting'],
            'flag'               => DataContainer::SORT_ASC,
            'panelLayout'        => 'search,filter,limit',
            'defaultSearchField' => 'alias',
        ],
        'label' => [
            'fields' => ['alias', 'type'],
            'format' => '%s <span class="tl_gray">[%s]</span>',
        ],
        'operations' => [
            'edit' => [
                'href' => 'act=edit',
                'icon' => 'edit.svg',
            ],
            'children' => [
                'href'       => 'table=tl_menu_category',
                'icon'       => 'children.svg',
                'attributes' => 'title="Kategorien"',
            ],
            'translations' => [
                'href'       => 'table=tl_menu_card_translation',
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
        'default' => '{type_legend},type,alias;{image_legend},singleSRC;{publish_legend},published,start,stop;{sorting_legend},sorting',
    ],

    'fields' => [
        'id' => [
            'sql' => ['type' => 'integer', 'unsigned' => true, 'autoincrement' => true],
        ],
        'tstamp' => [
            'sql' => ['type' => 'integer', 'unsigned' => true, 'default' => 0],
        ],
        'alias' => [
            'search'    => true,
            'inputType' => 'text',
            'eval'      => ['mandatory' => true, 'rgxp' => 'alias', 'unique' => true, 'maxlength' => 255, 'tl_class' => 'w50'],
            'sql'       => ['type' => 'string', 'length' => 255, 'default' => ''],
        ],
        'type' => [
            'filter'    => true,
            'inputType' => 'select',
            'options'   => ['hauptkarte', 'nebenkarte'],
            'reference' => &$GLOBALS['TL_LANG']['tl_menu_card']['type_options'],
            'eval'      => ['mandatory' => true, 'tl_class' => 'w50'],
            'sql'       => ['type' => 'string', 'length' => 32, 'default' => 'hauptkarte'],
        ],
        'singleSRC' => [
            'inputType' => 'fileTree',
            'eval'      => ['fieldType' => 'radio', 'filesOnly' => true, 'extensions' => 'jpg,jpeg,png,svg,webp', 'tl_class' => 'clr'],
            'sql'       => ['type' => 'binary', 'length' => 16, 'fixed' => true, 'notnull' => false],
        ],
        'published' => [
            'toggle' => true,
            'filter' => true,
            'inputType' => 'checkbox',
            'eval'      => ['doNotCopy' => true],
            'sql'       => ['type' => 'boolean', 'default' => false],
        ],
        'start' => [
            'inputType' => 'text',
            'eval'      => ['rgxp' => 'date', 'datepicker' => true, 'tl_class' => 'w50 wizard'],
            'sql'       => ['type' => 'string', 'length' => 10, 'default' => ''],
        ],
        'stop' => [
            'inputType' => 'text',
            'eval'      => ['rgxp' => 'date', 'datepicker' => true, 'tl_class' => 'w50 wizard'],
            'sql'       => ['type' => 'string', 'length' => 10, 'default' => ''],
        ],
        'sorting' => [
            'inputType' => 'text',
            'eval'      => ['rgxp' => 'natural', 'tl_class' => 'w50'],
            'sql'       => ['type' => 'integer', 'unsigned' => true, 'default' => 0],
        ],
    ],
];
