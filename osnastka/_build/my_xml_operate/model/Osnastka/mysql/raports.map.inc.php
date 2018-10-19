<?php
$xpdo_meta_map['Raports']= array (
  'package' => 'Osnastka',
  'version' => '1.1',
  'table' => 'raports',
  'extends' => 'xPDOSimpleObject',
  'tableMeta' => 
  array (
    'engine' => 'InnoDB',
  ),
  'fields' => 
  array (
    'z' => NULL,
    'mm' => NULL,
    'is_uses' => 0,
  ),
  'fieldMeta' => 
  array (
    'z' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => false,
      'index' => 'unique',
    ),
    'mm' => 
    array (
      'dbtype' => 'decimal',
      'precision' => '8,3',
      'phptype' => 'float',
      'null' => false,
      'index' => 'unique',
    ),
    'is_uses' => 
    array (
      'dbtype' => 'tinyint',
      'precision' => '1',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
  ),
  'indexes' => 
  array (
    'MM' => 
    array (
      'alias' => 'MM',
      'primary' => false,
      'unique' => true,
      'type' => 'BTREE',
      'columns' => 
      array (
        'mm' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
      ),
    ),
    'Z' => 
    array (
      'alias' => 'Z',
      'primary' => false,
      'unique' => true,
      'type' => 'BTREE',
      'columns' => 
      array (
        'z' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
      ),
    ),
  ),
);
