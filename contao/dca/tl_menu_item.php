<?php

declare(strict_types=1);

use Contao\DataContainer;
use Contao\DC_Table;
use DiamondsNetwork\MenuCardBundle\Dca\ItemChildRecordRenderer;
use Doctrine\DBAL\Platforms\AbstractMySQLPlatform;

$GLOBALS['TL_DCA']['tl_menu_item'] = [
    'config' => [
        'dataContainer'    => DC_Table::class,
        'ptable'           => 'tl_menu_category',
        'ctable'           => ['tl_menu_item_price', 'tl_menu_item_translation'],
        'switchToEdit'     => true,
        'enableVersioning' => true,
        'markAsCopy'       => 'title',
        'sql'              => [
            'keys' => [
                'id'  => 'primary',
                'pid' => 'index',
            ],
        ],
    ],

    'list' => [
        'sorting' => [
            'mode'                   => DataContainer::MODE_PARENT,
            'fields'                 => ['sorting'],
            'panelLayout'            => 'search,limit',
            'headerFields'           => ['title'],
            'child_record_callback'  => [ItemChildRecordRenderer::class, 'render'],
        ],
        'label' => [
            'fields' => ['title'],
            'format' => '%s',
        ],
        'operations' => [
            'edit' => [
                'href' => 'act=edit',
                'icon' => 'edit.svg',
            ],
            'children' => [
                'href'       => 'table=tl_menu_item_price',
                'icon'       => 'children.svg',
                'attributes' => 'title="Preise"',
            ],
            'translations' => [
                'href'       => 'table=tl_menu_item_translation',
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
        'default' => '{title_legend},title,description;{publish_legend},published;{dietary_legend},dietary;{additive_legend},additives;{allergen_legend},allergens',
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
        'published' => [
            'toggle'    => true,
            'filter'    => true,
            'inputType' => 'checkbox',
            'eval'      => ['doNotCopy' => true],
            'sql'       => ['type' => 'boolean', 'default' => false],
        ],
        'dietary' => [
            'inputType' => 'checkbox',
            'options'   => ['vegan', 'vegetarian'],
            'reference' => &$GLOBALS['TL_LANG']['tl_menu_item']['dietary_options'],
            'eval'      => ['multiple' => true, 'tl_class' => 'clr'],
            'sql'       => ['type' => 'blob', 'length' => AbstractMySQLPlatform::LENGTH_LIMIT_BLOB, 'notnull' => false],
        ],
        'additives' => [
            'inputType'  => 'checkboxWizard',
            'foreignKey' => 'tl_menu_additive.number',
            'eval'       => ['multiple' => true, 'tl_class' => 'clr'],
            'sql'        => ['type' => 'blob', 'length' => AbstractMySQLPlatform::LENGTH_LIMIT_BLOB, 'notnull' => false],
            'relation'   => ['type' => 'belongsToMany', 'load' => 'lazy'],
        ],
        'allergens' => [
            'inputType'  => 'checkboxWizard',
            'foreignKey' => 'tl_menu_allergen.code',
            'eval'       => ['multiple' => true, 'tl_class' => 'clr'],
            'sql'        => ['type' => 'blob', 'length' => AbstractMySQLPlatform::LENGTH_LIMIT_BLOB, 'notnull' => false],
            'relation'   => ['type' => 'belongsToMany', 'load' => 'lazy'],
        ],
    ],
];
