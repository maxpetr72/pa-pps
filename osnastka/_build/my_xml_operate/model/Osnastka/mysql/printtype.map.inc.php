<?php
$xpdo_meta_map['PrintType']= array (
  'package' => 'Osnastka',
  'version' => '1.1',
  'table' => 'print_type',
  'extends' => 'xPDOSimpleObject',
  'tableMeta' => 
  array (
    'engine' => 'InnoDB',
  ),
  'fields' => 
  array (
    'pr_type_name_en' => NULL,
    'pr_type_name_ru' => NULL,
  ),
  'fieldMeta' => 
  array (
    'pr_type_name_en' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '50',
      'phptype' => 'string',
      'null' => false,
      'index' => 'unique',
    ),
    'pr_type_name_ru' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '50',
      'phptype' => 'string',
      'null' => false,
      'index' => 'unique',
    ),
  ),
  'indexes' => 
  array (
    'pr_type_name_en' => 
    array (
      'alias' => 'pr_type_name_en',
      'primary' => false,
      'unique' => true,
      'type' => 'BTREE',
      'columns' => 
      array (
        'pr_type_name_en' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
      ),
    ),
    'pr_type_name_ru' => 
    array (
      'alias' => 'pr_type_name_ru',
      'primary' => false,
      'unique' => true,
      'type' => 'BTREE',
      'columns' => 
      array (
        'pr_type_name_ru' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
      ),
    ),
  ),
);
