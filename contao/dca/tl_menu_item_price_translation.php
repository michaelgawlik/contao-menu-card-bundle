<?php

declare(strict_types=1);

use Contao\DataContainer;
use Contao\DC_Table;
use DiamondsNetwork\MenuCardBundle\Dca\LanguageOptions;

$GLOBALS['TL_DCA']['tl_menu_item_price_translation'] = [
    'config' => [
        'dataContainer'    => DC_Table::class,
        'ptable'           => 'tl_menu_item_price',
        'enableVersioning' => true,
        'sql'              => [
            'keys' => [
                'id'           => 'primary',
                'pid,language' => 'unique',
            ],
        ],
    ],

    'list' => [
        'sorting' => [
            'mode'        => DataContainer::MODE_PARENT,
            'fields'      => ['language'],
            'flag'        => DataContainer::SORT_ASC,
            'panelLayout' => 'search,limit',
        ],
        'label' => [
            'fields' => ['language', 'label'],
            'format' => '[%s] %s',
        ],
    ],

    'palettes' => [
        'default' => '{language_legend},language;{label_legend},label',
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
        'language' => [
            'inputType'        => 'select',
            'options_callback' => [LanguageOptions::class, 'getAdditional'],
            'eval'             => ['mandatory' => true, 'tl_class' => 'w50'],
            'sql'              => ['type' => 'string', 'length' => 5, 'default' => ''],
        ],
        'label' => [
            'search'    => true,
            'inputType' => 'text',
            'eval'      => ['mandatory' => true, 'maxlength' => 64, 'tl_class' => 'w50'],
            'sql'       => ['type' => 'string', 'length' => 64, 'default' => ''],
        ],
    ],
];
