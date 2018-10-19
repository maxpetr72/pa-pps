<?php
$xpdo_meta_map['EqupmentList']= array (
  'package' => 'Osnastka',
  'version' => '1.1',
  'table' => 'equpment_list',
  'extends' => 'xPDOSimpleObject',
  'tableMeta' => 
  array (
    'engine' => 'InnoDB',
  ),
  'fields' => 
  array (
    'eq_type_name_id' => NULL,
    'eq_list' => NULL,
  ),
  'fieldMeta' => 
  array (
    'eq_type_name_id' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => false,
      'index' => 'index',
    ),
    'eq_list' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '5',
      'phptype' => 'string',
      'null' => false,
      'index' => 'index',
    ),
  ),
  'indexes' => 
  array (
    'papps_osn_equpment_list_eq_type_name_id_idx' => 
    array (
      'alias' => 'papps_osn_equpment_list_eq_type_name_id_idx',
      'primary' => false,
      'unique' => false,
      'type' => 'BTREE',
      'columns' => 
      array (
        'eq_type_name_id' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
      ),
    ),
    'papps_osn_equpment_list_eq_list_idx' => 
    array (
      'alias' => 'papps_osn_equpment_list_eq_list_idx',
      'primary' => false,
      'unique' => false,
      'type' => 'BTREE',
      'columns' => 
      array (
        'eq_list' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
      ),
    ),
  ),
);
