<?php
/**
 * Create our xml-schem from DB tables
 * -----------------------------------
 */


/**
 * Include xmlHndlMyLog class as log of this script
 */
/**
 * @var string $xmlHndlMyLogPath Represented full path to log class file 
 * for this script
 */
$xmlHndlMyLogPath = dirname(__FILE__)."/xmlHndlMyLog.class.php";

/** 
 * Check existing path to log class file for this script
 */
if (!file_exists($xmlHndlMyLogPath)){
    die("<br/>Can't find log file for this script<br/>");
}

require_once ($xmlHndlMyLogPath);
unset($xmlHndlMyLogPath);

/**
 * @var xmlHndlMyLog $myLog
 * Main log class as set of output strings (for this script).
 * Object for contain output information (strings) (aka log) 
 * accoding output leval.
 */
$myLog = new xmlHndlMyLog();


/**
 * Include config class of this script
 */
/**
 * @var string $cfgPath Represented full path to config file for this script
 */
$cfgPath = dirname(__FILE__)."/xmlHndlConf.class.php";
$myLog->setOutputStr(
        '<br/>$cfgPath = "'.$cfgPath.'"<br/>', 
        xmlHndlMyLog::OUT_LEVEL_DEBUG);
$myLog->setOutputStr("----- -----<br/>", xmlHndlMyLog::OUT_LEVEL_DEBUG);

/** 
 * Check existing config file to this script
 */
$myLog->setOutputStr(
        "<br/>Check existing config file to this script", 
        xmlHndlMyLog::OUT_LEVEL_INFO);
if (!file_exists($cfgPath)){
    $myLog->setOutputStr(
            "<br/>Can't find config file to this script<br/>", 
            xmlHndlMyLog::OUT_LEVEL_ERROR);
    die($myLog->getOutputStr(xmlHndlMyLog::OUT_LEVEL_ERROR));
}
$myLog->setOutputStr(": OK<br/>", xmlHndlMyLog::OUT_LEVEL_INFO);

require_once ($cfgPath);
unset($cfgPath);

/**
 * @var xmlHndlConf $xmlHndlCfg
 * Main config class as set of configuration set (for this script).
 */
$xmlHndlCfg = new xmlHndlConf();
/**
 * Output parameters in main (configuration) object as set (for this script).
 */
foreach ($xmlHndlCfg as $cfgKey => $cfgValue) {
    $myLog->setOutputStr(
            "\$xmlHndlCfg->{$cfgKey} => \"{$cfgValue}\"<br/>", 
            xmlHndlMyLog::OUT_LEVEL_DEBUG);
}
$myLog->setOutputStr("<br/>----- -----<br/>", xmlHndlMyLog::OUT_LEVEL_DEBUG);
unset($cfgValue, $cfgKey);

/**
 * Check existing folder for save and handle xml fele 
 * 
 * ($xmlHndlCfg->schemaPath)
 */
$myLog->setOutputStr(
        "<br/>Check existing folder for save and handle xml-file", 
        xmlHndlMyLog::OUT_LEVEL_INFO);
if (!is_dir($xmlHndlCfg->schemaPath)){
    $myLog->setOutputStr(
            "<br/>Can't find folder for save and handle xml-file." 
            . " Try to create it... ", 
            xmlHndlMyLog::OUT_LEVEL_INFO);
    $isMkDir = mkdir(
            $xmlHndlCfg->schemaPath, 
            $xmlHndlCfg->schemaPathMode, 
            $xmlHndlCfg->schemaPathIsRecurs);
    if(!$isMkDir){
        $myLog->setOutputStr(
                "<br/>Can't create folder for save and handle xml-file<br/>",
                xmlHndlMyLog::OUT_LEVEL_ERROR);
        die($myLog->getOutputStr(xmlHndlMyLog::OUT_LEVEL_ERROR));
    }
//    die($myLog->getOutputStr(xmlHndlMyLog::OUT_LEVEL_ERROR));
}
$myLog->setOutputStr(": OK<br/>", xmlHndlMyLog::OUT_LEVEL_INFO);

/** 
 * *******************************************************
 * We load the main file-config of the site or we have to prescribe all 
 * the basic settings.
 * Подгружаем основной файл-конфиг сайта или самим придется прописывать 
 * все основные настройки
 * 
 * ($xmlHndlCfg->coreConfigPath)
 */

/** 
 * Check existing site config file
 */
$myLog->setOutputStr(
        "<br/>Check existing site config file", 
        xmlHndlMyLog::OUT_LEVEL_INFO);
if (!file_exists($xmlHndlCfg->coreConfigPath)){
    $myLog->setOutputStr(
            "<br/>Can't find site config file<br/>", 
            xmlHndlMyLog::OUT_LEVEL_ERROR);
    die($myLog->getOutputStr(xmlHndlMyLog::OUT_LEVEL_ERROR));
}
$myLog->setOutputStr(": OK<br/>", xmlHndlMyLog::OUT_LEVEL_INFO);

/** 
 * Output content from site config file
 */
$myLog->setOutputStr("<pre>", xmlHndlMyLog::OUT_LEVEL_DEBUG);
$myLog->setOutputStr(
        htmlspecialchars(
                file_get_contents($xmlHndlCfg->coreConfigPath)
            ),
        xmlHndlMyLog::OUT_LEVEL_DEBUG);
$myLog->setOutputStr("</pre>", xmlHndlMyLog::OUT_LEVEL_DEBUG);

// Подружаем config MODx
require_once ($xmlHndlCfg->coreConfigPath);

// Подружаем основной класс MODx
include_once (MODX_CORE_PATH . '/model/modx/modx.class.php');

/**
 * @var modX $modx 
 * Инициализируем класс MODx
 */
$modx = new modX();
$myLog->setOutputStr(
        "<br/>MODx class initialization: OK<br/>", 
        xmlHndlMyLog::OUT_LEVEL_INFO);

//// Инициализируем контекст, если принципиально
// $modx->initialize('mgr');

// Устанавливаем настройки логирования
// Не обязательно
$modx->setLogLevel(modX::LOG_LEVEL_INFO);
$modx->setLogTarget(XPDO_CLI_MODE ? 'ECHO' : 'HTML');

// !!! Обязательно!???
// Подгружаем основной класс-пакер
//$myLog->setOutputStr(
//        "<br/>loading main class-paker", 
//        xmlHndlMyLog::OUT_LEVEL_INFO);
//$modx->addPackage('transport.modPackageBuilder', '', false, true);
//$myLog->setOutputStr(
//        ": OK<br/>", 
//        xmlHndlMyLog::OUT_LEVEL_INFO);

//// Указатель типа базы данных (MySQL / MsSQL и т.п.)
$myLog->setOutputStr(
        "<br/>Create DB type pointer (manager) (MySQL / MsSQL)", 
        xmlHndlMyLog::OUT_LEVEL_INFO);
/**
 * @var xPDOManager $manager
 */
$manager = $modx->getManager();
if ($manager !== NULL){
    $myLog->setOutputStr(": OK<br/>", xmlHndlMyLog::OUT_LEVEL_INFO);
}

//// Класс-генератор схем
$myLog->setOutputStr(
        "<br/>Class - schem generation", 
        xmlHndlMyLog::OUT_LEVEL_INFO);
/**
 * @var xPDOGenerator $generator
 */
$generator = $manager->getGenerator();
if ($generator instanceof xPDOGenerator) {
    $myLog->setOutputStr(": OK<br/>", xmlHndlMyLog::OUT_LEVEL_INFO);
}

//// Генерируем файл-XML
//// /xpdo/om/mysql/xpdogenerator.class.php

//// public function writeSchema(
////         $schemaFile, $package= '', $baseClass= '', 
////         $tablePrefix= '', $restrictPrefix= false)
//// $tablePrefix - указываем, если хотим только те таблицы, которые начинаются 
//// с этого префикса.
//// $restrictPrefix - указывает true, если хотим получить таблицы только по 
//// префиксу
//$xml= $generator->writeSchema(
//        $Schema, 
//        $obj, 
//        'xPDOObject', 
//        $tablePrefix, 
//        $restrictPrefix=true
//        );
$xml = $generator->writeSchema(
        $xmlHndlCfg->schemaFullPath,
        $xmlHndlCfg->objName, 
        $xmlHndlCfg->baseClass, 
        $xmlHndlCfg->tablePrefix, 
        $xmlHndlCfg->restrictPrefix
        );

//// Создает классы и мапы (php) по схеме xml
//$generator->parseSchema($Schema, $Path); 
$generator->parseSchema(
        $xmlHndlCfg->schemaFullPath, 
        $xmlHndlCfg->schemaPath
        ); 

//addPacage()
//if(!$modx->addPackage('mypackage','/full/path/to/core/components/mypackage/model/','mp_')) {
//    return 'There was a problem adding your package!  Check the logs for more info!';
//}
//$my_items = $modx->getCollection('Items');
//$output = '';
//if ($my_items) {
//    foreach ($my_items as $item) {
//        $output .= $item->get('itemname') . '<br/>';
//    }
//}
//else {
//    return 'No items found.';
//}
//return $output;
//if(!$modx->addPackage('mypackage','/full/path/to/core/components/mypackage/model/','mp_')) {
//    return 'There was a problem adding your package!  Check the logs for more info!';
//}
if(!$modx->addPackage(
        $xmlHndlCfg->objName,
        $xmlHndlCfg->schemaPath,
        $xmlHndlCfg->tablePrefix)
        ) {
    $myLog->setOutputStr(
            "<br/>There was a problem adding your package! " . 
            "Check the logs for more info!<br/>",
            xmlHndlMyLog::OUT_LEVEL_ERROR);
    die ($myLog->getOutputStr(xmlHndlMyLog::OUT_LEVEL_ERROR));
}
$my_items = $modx->getCollection('EqupmentType');
$output = '';
if ($my_items) {
    foreach ($my_items as $item) {
        $output .= $item->get('eq_type_name') . '<br/>';
    }
}
else {
    $myLog->setOutputStr(
            "<br/>No items found.<br/>",
            xmlHndlMyLog::OUT_LEVEL_ERROR);
    die ($myLog->getOutputStr(xmlHndlMyLog::OUT_LEVEL_ERROR));
}
$myLog->setOutputStr($output, xmlHndlMyLog::OUT_LEVEL_INFO);

$myLog->setOutputStr("<br/>Выполнено", xmlHndlMyLog::OUT_LEVEL_INFO);
//print $myLog->getOutputStr(xmlHndlMyLog::OUT_LEVEL_ERROR);
print $myLog->getOutputStr(xmlHndlMyLog::OUT_LEVEL_INFO);
//print $myLog->getOutputStr(xmlHndlMyLog::OUT_LEVEL_DEBUG);
