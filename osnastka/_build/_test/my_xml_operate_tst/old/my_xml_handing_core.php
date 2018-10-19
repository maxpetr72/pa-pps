<?php
/*******************************************************/
/* Конфиги нашей схемы */
/*******************************************************/

/**
 * @var string $cfg Represented full path to config file for this scri[t
 */
$cfg = dirname(__FILE__)."/my_xml_handing_config.php";
if (!file_exists($cfg)){
    die("Can't find config file to this script");
}

/**
 * @var Array $my_xml_hndl_cfg
 */
$my_xml_hndl_cfg =
require_once ($cfg);

echo "\$cfg = \"$cfg\"<br/>";
echo "<br/>";
foreach ($my_xml_hndl_cfg as $cfg_key => $cfg_value) {
    echo "\$my_xml_hndl_cfg['"."$cfg_key"."'] = \""."$cfg_value"."\"<br/>";
}
echo "<br/>";

if (!file_exists($my_xml_hndl_cfg['coreCfgPath'])){
    die("Can't find site config file");
}

echo  "<pre>";
echo  
    htmlspecialchars(
            file_get_contents($my_xml_hndl_cfg['coreCfgPath'])
    )
;
echo  "</pre>";

//// Имя Класса. Так будет потом называться Класс при вызове $modx->addPackage()
//$obj = 'Osnastka'; 
$obj = $my_xml_hndl_cfg['name'];

/*
Префикс таблиц. Если префикс не отличается от системного, то можно вообще не указывать.
К сожалению, xPDO при генерации не позволяет перечислять имена конкретных таблиц,
которые нам нужны, а позволяет отсеять только по префиксу.
*/
//$tableComonPrefix='papps_';
//$tablePrefix=$tableComonPrefix.'osn_';
$tableComonPrefix = $my_xml_hndl_cfg['tableComonPrefix'];
$tablePrefix = $my_xml_hndl_cfg['tablePrefix'];

//// Папка, где будет записана XML-схема и все файлы создаваемого объекта
//// Путь к файлам класса вы будете потом прописывать в вызове метода $modx->addPackage();
//$Path = dirname(__FILE__).'/model/';
$Path = $my_xml_hndl_cfg['schemaPath'];
//echo $my_xml_hndl_cfg['schemaPath'];
//echo "<br/>";

//// Файл-схема
//$Schema = $Path
////        .'/'
//        .$obj.'.mysql.schema.xml';
$Schema = $my_xml_hndl_cfg['schema'];
//echo $my_xml_hndl_cfg['schema'];
//echo "<br/>";
///*******************************************************/
//// Подгружаем основной файл-конфиг сайта или самим придется прописывать все основные настройки
//// core_config_path
//$core_cfg_path = 
//        'e:/_maxp_private/YandexDisk/_maxp_private/my_sites_prj/'
//        .'_my_sites/pa-pps.loc/'
//        .'core_papps/config/config.inc.php';
////require_once 
////        dirname(
////                dirname(
////                        dirname(
////                                dirname(
////                                        dirname(__FILE__)
////                                        )
////                                )
////                        )
////                ).'/core_'.$tableComonPrefix.'/config/config.inc.php';
//require_once $core_cfg_path;

//// Подружаем основной класс MODx
//include_once MODX_CORE_PATH . 'model/modx/modx.class.php';

//// Инициализируем класс MODx
//$modx= new modX();

//// Инициализируем контекст, если принципиально
//// $modx->initialize('mgr');
//
//// Устанавливаем настройки логирования
//// Не обязательно
//$modx->setLogLevel(modX::LOG_LEVEL_INFO);
//$modx->setLogTarget(XPDO_CLI_MODE ? 'ECHO' : 'HTML');

//// !!! Обязательно!
//// Подгружаем основной класс-пакер
////$modx->addPackage('transport.modPackageBuilder', '', false, true);
//
//// Указатель типа базы данных (MySQL / MsSQL и т.п.)
//$manager = $modx->getManager();

//// Класс-генератор схем
//$generator = $manager->getGenerator();

//// Генерируем файл-XML
//// /xpdo/om/mysql/xpdogenerator.class.php
//
//// public function writeSchema($schemaFile, $package= '', $baseClass= '', $tablePrefix= '', $restrictPrefix= false)
//// $tablePrefix - указываем, если хотим только те таблицы, которые начинаются с этого префикса.
//// $restrictPrefix - указывает true, если хотим получить таблицы только по префиксу
//$xml= $generator->writeSchema($Schema, $obj, 'xPDOObject', $tablePrefix ,$restrictPrefix=true );

//// Создает классы и мапы (php) по схеме xml
//$generator->parseSchema($Schema, $Path); 

//print "<br /><br />Выполнено";
