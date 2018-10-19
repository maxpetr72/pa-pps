<?php
/**
 * Create our xml-schem from DB tables
 * -----------------------------------
 */


/**
 * Include config class of this script
 */
/**
 * @var string $cfgPath Represented full path to config file for this script
 */
$cfgPath = dirname(__FILE__)."/xmlHndlConf.class.php";
/** @var array() the temprory output logging strings */
$tmpOutLog['ERROR'] = '';
$tmpOutLog['INFO'] = '';
$tmpOutLog['DEBUG'] = '';

$tmpOutLog['DEBUG'] .= '<br/>$cfgPath = "'.$cfgPath.'"<br/>';
$tmpOutLog['DEBUG'] .= "----- -----<br/>";

/** 
 * Check existing config file to this script
 */
$tmpOutLog['INFO'] .= "<br/>Check existing config file to this script";
$tmpOutLog['DEBUG'] .= "<br/>Check existing config file to this script";
if (!file_exists($cfgPath)){
    $tmpOutLog['ERROR'] .= "<br/>Can't find config file to this script<br/>";
    $tmpOutLog['INFO'] .= "<br/>Can't find config file to this script<br/>";
    $tmpOutLog['DEBUG'] .= "<br/>Can't find config file to this script<br/>";
    die($tmpOutLog['ERROR']);
}
$tmpOutLog['INFO'] .= ": OK<br/>";
$tmpOutLog['DEBUG'] .= ": OK<br/>";

require_once ($cfgPath);
unset($cfgPath);

/**
 * @var xmlHndlConf $xmlHndlCfg
 * Main config class as set of configuration set (for this script).
 */
$xmlHndlCfg = new xmlHndlConf();
$xmlHndlCfg->log->setOutputStr($tmpOutLog['ERROR'], xmlHndlLog::OUT_LEVEL_ERROR);
$xmlHndlCfg->log->setOutputStr($tmpOutLog['INFO'], xmlHndlLog::OUT_LEVEL_INFO);
$xmlHndlCfg->log->setOutputStr($tmpOutLog['DEBUG'], xmlHndlLog::OUT_LEVEL_DEBUG);
unset($tmpOutLog);

/**
 * Output parameters in main (configuration) object as set (for this script).
 */
foreach ($xmlHndlCfg as $cfgKey => $cfgValue) {
//    $xmlHndlCfg->log->setOutputStr(
//            "\$xmlHndlCfg->{$cfgKey} => \"{$cfgValue}\"<br/>", 
//                    xmlHndlLog::OUT_LEVEL_DEBUG);
    $outStr = is_object($cfgValue)? " is an object" : $cfgKey;
    $xmlHndlCfg->log->setOutputStr(
            "\$xmlHndlCfg->{$cfgKey} => \"{$outStr}\"<br/>", 
                    xmlHndlLog::OUT_LEVEL_DEBUG);
}
$xmlHndlCfg->log->setOutputStr(
        "<br/>----- -----<br/>", 
                xmlHndlLog::OUT_LEVEL_DEBUG);
unset($cfgValue, $cfgKey, $outStr);

/**
 * Check existing folder for save and handle xml fele 
 * 
 * ($xmlHndlCfg->schemaPath)
 */
$xmlHndlCfg->log->setOutputStr(
        "<br/>Check existing folder for save and handle xml-file", 
            xmlHndlLog::OUT_LEVEL_INFO);
if (!is_dir($xmlHndlCfg->schemaPath)){
    $xmlHndlCfg->log->setOutputStr(
            "<br/>Can't find folder for save and handle xml-file." 
            . " Try to create it... ", 
                xmlHndlLog::OUT_LEVEL_INFO);
//    $isMkDir = mkdir(
//            $xmlHndlCfg->schemaPath, 
//            $xmlHndlCfg->schemaPathMode, 
//            $xmlHndlCfg->schemaPathIsRecurs);
//    if(!$isMkDir){
//        $xmlHndlCfg->log->setOutputStr(
//                "<br/>Can't create folder for save and handle xml-file<br/>",
//                    xmlHndlLog::OUT_LEVEL_ERROR);
//        die($xmlHndlCfg->log->getOutputStr(xmlHndlLog::OUT_LEVEL_ERROR));
//    }
    if(!mkdir(
            $xmlHndlCfg->schemaPath, 
            $xmlHndlCfg->schemaPathMode, 
            $xmlHndlCfg->schemaPathIsRecurs
            )
    )
    {
        $xmlHndlCfg->log->setOutputStr(
                "<br/>Can't create folder for save and handle xml-file<br/>",
                    xmlHndlLog::OUT_LEVEL_ERROR);
        die($xmlHndlCfg->log->getOutputStr(xmlHndlLog::OUT_LEVEL_ERROR));
    }
}
$xmlHndlCfg->log->setOutputStr(": OK<br/>", xmlHndlLog::OUT_LEVEL_INFO);

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
$xmlHndlCfg->log->setOutputStr(
        "<br/>Check existing site config file", 
        xmlHndlLog::OUT_LEVEL_INFO);
if (!file_exists($xmlHndlCfg->coreConfigPath)){
    $xmlHndlCfg->log->setOutputStr(
            "<br/>Can't find site config file<br/>", 
            xmlHndlLog::OUT_LEVEL_ERROR);
    die($xmlHndlCfg->log->getOutputStr(xmlHndlLog::OUT_LEVEL_ERROR));
}
$xmlHndlCfg->log->setOutputStr(": OK<br/>", xmlHndlLog::OUT_LEVEL_INFO);

/** 
 * Output content from site config file
 */
$xmlHndlCfg->log->setOutputStr("<pre>", xmlHndlLog::OUT_LEVEL_DEBUG);
$xmlHndlCfg->log->setOutputStr(
        htmlspecialchars(
                file_get_contents($xmlHndlCfg->coreConfigPath)
            ),
        xmlHndlLog::OUT_LEVEL_DEBUG);
$xmlHndlCfg->log->setOutputStr("</pre>", xmlHndlLog::OUT_LEVEL_DEBUG);

// Подружаем config MODx
require_once ($xmlHndlCfg->coreConfigPath);

// Подружаем основной класс MODx
include_once (MODX_CORE_PATH . '/model/modx/modx.class.php');

/**
 * @var modX $modx 
 * Инициализируем класс MODx
 */
$modx = new modX();
$xmlHndlCfg->log->setOutputStr(
        "<br/>MODx class initialization: OK<br/>", 
        xmlHndlLog::OUT_LEVEL_INFO);

//// Инициализируем контекст, если принципиально
// $modx->initialize('mgr');

// Устанавливаем настройки логирования
// Не обязательно
$modx->setLogLevel(modX::LOG_LEVEL_INFO);
$modx->setLogTarget(XPDO_CLI_MODE ? 'ECHO' : 'HTML');

// !!! Обязательно!???
// Подгружаем основной класс-пакер
//$xmlHndlCfg->log->setOutputStr(
//        "<br/>loading main class-paker", 
//        xmlHndlLog::OUT_LEVEL_INFO);
//$modx->addPackage('transport.modPackageBuilder', '', false, true);
//$xmlHndlCfg->log->setOutputStr(
//        ": OK<br/>", 
//        xmlHndlLog::OUT_LEVEL_INFO);

//// Указатель типа базы данных (MySQL / MsSQL и т.п.)
$xmlHndlCfg->log->setOutputStr(
        "<br/>Create DB type pointer (manager) (MySQL / MsSQL)", 
        xmlHndlLog::OUT_LEVEL_INFO);
/**
 * @var xPDOManager $manager
 */
$manager = $modx->getManager();
if ($manager !== NULL){
    $xmlHndlCfg->log->setOutputStr(": OK<br/>", xmlHndlLog::OUT_LEVEL_INFO);
}

//// Класс-генератор схем
$xmlHndlCfg->log->setOutputStr(
        "<br/>Class - schem generation", 
        xmlHndlLog::OUT_LEVEL_INFO);
/**
 * @var xPDOGenerator $generator
 */
$generator = $manager->getGenerator();
if ($generator instanceof xPDOGenerator) {
    $xmlHndlCfg->log->setOutputStr(": OK<br/>", xmlHndlLog::OUT_LEVEL_INFO);
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
    $xmlHndlCfg->log->setOutputStr(
            "<br/>There was a problem adding your package! " . 
            "Check the logs for more info!<br/>",
            xmlHndlLog::OUT_LEVEL_ERROR);
    die ($myLog->getOutputStr(xmlHndlLog::OUT_LEVEL_ERROR));
}
$my_items = $modx->getCollection('EqupmentType');
$output = '';
if ($my_items) {
    foreach ($my_items as $item) {
        $output .= $item->get('eq_type_name') . '<br/>';
    }
}
else {
    $xmlHndlCfg->log->setOutputStr(
            "<br/>No items found.<br/>",
            xmlHndlLog::OUT_LEVEL_ERROR);
    die ($myLog->getOutputStr(xmlHndlLog::OUT_LEVEL_ERROR));
}
$xmlHndlCfg->log->setOutputStr($output, xmlHndlLog::OUT_LEVEL_INFO);

$xmlHndlCfg->log->setOutputStr("<br/>Выполнено", xmlHndlLog::OUT_LEVEL_INFO);
////print $xmlHndlCfg->log->getOutputStr(xmlHndlLog::OUT_LEVEL_ERROR);
//print $xmlHndlCfg->log->getOutputStr(xmlHndlLog::OUT_LEVEL_INFO);
////print $xmlHndlCfg->log->getOutputStr(xmlHndlLog::OUT_LEVEL_DEBUG);
print $xmlHndlCfg->log->getOutputStr($xmlHndlCfg->log->getOutputLev());
