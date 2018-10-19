<?php
/*******************************************************/
/* Конфиги нашей схемы */
/*******************************************************/
/**
 * @var string $coreCfgPath Represented full path to 
 * site config file in core folder
 */
$coreCfgPath = 'e:/_maxp_private/YandexDisk/_maxp_private/my_sites_prj/'
            .'_my_sites/pa-pps.loc/'
            .'core_papps/config/config.inc.php';

$objName = 'Osnastka';
$objNameLowcase = strtolower($objName);

$tableComonPrefix = 'papps_';
$tablePrefix = $tableComonPrefix.'osn_';

$schemaPath = dirname(__FILE__).'/model/';
            
return [
    // Подгружаем основной файл-конфиг сайта или самим придется 
    // прописывать все основные настройки
    'coreCfgPath' => $coreCfgPath,

    // Имя Класса. Так будет потом называться Класс при вызове $modx->addPackage()
    'name' => $objName,
    'nameLowerCase' => $objNameLowcase,
    
    //    Префикс таблиц. Если префикс не отличается от системного, 
    //    то можно вообще не указывать.
    //    К сожалению, xPDO при генерации не позволяет перечислять 
    //    имена конкретных таблиц, которые нам нужны, а позволяет 
    //    отсеять только по префиксу.
    'tableComonPrefix' => $tableComonPrefix,
    'tablePrefix' => $tablePrefix,

    // Папка, где будет записана XML-схема и все файлы создаваемого объекта
    // Путь к файлам класса вы будете потом прописывать 
    // в вызове метода $modx->addPackage();
    'schemaPath' => $schemaPath,

    // Файл-схема
    'schemaFullPath' => $schemaPath.$objNameLowcase.'.mysql.schema.xml',
];
