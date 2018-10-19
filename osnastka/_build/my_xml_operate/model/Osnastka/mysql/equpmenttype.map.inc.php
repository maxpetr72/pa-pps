<?php
$xpdo_meta_map['EqupmentType']= array (
  'package' => 'Osnastka',
  'version' => '1.1',
  'table' => 'equpment_type',
  'extends' => 'xPDOSimpleObject',
  'tableMeta' => 
  array (
    'engine' => 'InnoDB',
  ),
  'fields' => 
  array (
    'eq_type_name' => NULL,
    'eq_type_code' => NULL,
  ),
  'fieldMeta' => 
  array (
    'eq_type_name' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '50',
      'phptype' => 'string',
      'null' => false,
      'index' => 'unique',
    ),
    'eq_type_code' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '5',
      'phptype' => 'string',
      'null' => false,
      'index' => 'unique',
    ),
  ),
  'indexes' => 
  array (
    'eq_type_name' => 
    array (
      'alias' => 'eq_type_name',
      'primary' => false,
      'unique' => true,
      'type' => 'BTREE',
      'columns' => 
      array (
        'eq_type_name' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
      ),
    ),
    'eq_type_code' => 
    array (
      'alias' => 'eq_type_code',
      'primary' => false,
      'unique' => true,
      'type' => 'BTREE',
      'columns' => 
      array (
        'eq_type_code' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
      ),
    ),
  ),
);
