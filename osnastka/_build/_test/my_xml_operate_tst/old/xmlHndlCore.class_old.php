<?php
/**
 * Create our xml-schem from DB tables
 * -----------------------------------
 */

/**
 * Description of myOut.
 * 
 * Class for output (as logging).
 * 
 * @package xmlhandle
 */
class myOut {
    /**
     * The parameter define level of verbose messages
     * @const OUT_LEVEL_ERROR Output only errors messages
     * @const OUT_LEVEL_INFO Output errors and information messages
     * @const OUT_LEVEL_debug Output all messages (very verbose)
     */
    const OUT_LEVEL_ERROR = 0;
    /**
     * @ignore {@see OUT_LEVEL_ERROR}
     */
    const OUT_LEVEL_INFO = 1;
    /**
     * @ignore {@see OUT_LEVEL_ERROR}
     */
    const OUT_LEVEL_DEBUG = 2;
    
    /**
     * @var array Array of strings which prepear to out in browser 
     * 'error', 'info', 'debug', etc.
     */
    private $outputStr = array(
        myOut::OUT_LEVEL_ERROR => "",
        myOut::OUT_LEVEL_INFO => "",
        myOut::OUT_LEVEL_DEBUG => "",
    );
    
    /**
     * @var mixed $curOutLev Set current output level
     */
    private $curOutLev = myOut::OUT_LEVEL_DEBUG;
    
    /**
     * Set current output level
     * 
     * @return void
     */
    public function setOutputLev ($outLev = myOut::OUT_LEVEL_ERROR){
        /* @var $curOutLev string */
        $this->curOutLev = $outLev;
    }
    
    /**
     * Set output string wich correspoding with current output level
     * 
     * @param string The string for add to output
     * @param string The string for spesified output leval. As defaulf is full
     * out (i.e. OUT_LEVEL_DEBUG)
     * @return void
     */
    public function setOutputStr (
            $str2out = "", 
            $outLev = myOut::OUT_LEVEL_DEBUG
            ){
        if (!isset($str2out) || $str2out == "" || $str2out == NULL){
            return;
        }
        if (!isset($outLev) || !array_key_exists($outLev, $this->outputStr)){
            return;
        }
        if (isset($outLev)){
            if ($outLev == myOut::OUT_LEVEL_ERROR){
                $this->outputStr[myOut::OUT_LEVEL_ERROR] .= $str2out;
                $this->outputStr[myOut::OUT_LEVEL_INFO] .= $str2out;
                $this->outputStr[myOut::OUT_LEVEL_DEBUG] .= $str2out;
            }
            if ($outLev == myOut::OUT_LEVEL_INFO){
                $this->outputStr[myOut::OUT_LEVEL_INFO] .= $str2out;
                $this->outputStr[myOut::OUT_LEVEL_DEBUG] .= $str2out;
            }
            if ($outLev == myOut::OUT_LEVEL_DEBUG){
                $this->outputStr[myOut::OUT_LEVEL_DEBUG] .= $str2out;
            }
        }
    }
    
    /**
     * Get output string wich correspoding with current output level
     * 
     * @param string The string for spesified output leval. As defaulf is full
     * out (i.e. OUT_LEVEL_DEBUG)
     * @return string The string for output for browser any else
     */
    public function getOutputStr (
            $outLev = myOut::OUT_LEVEL_DEBUG
            ){
        if (!isset($outLev) || !array_key_exists($outLev, $this->outputStr)){
            return "";
        }
        if (isset($outLev)) {
            if($outLev == myOut::OUT_LEVEL_ERROR){
                return $this->outputStr[myOut::OUT_LEVEL_ERROR];
            }
            if($outLev == myOut::OUT_LEVEL_INFO){
                return $this->outputStr[myOut::OUT_LEVEL_INFO];
            }
            if($outLev == myOut::OUT_LEVEL_DEBUG){
                return $this->outputStr[myOut::OUT_LEVEL_DEBUG];
            }
        }
    }
    
    /**
     * Constract a new myOut instance
     */
    public function __construct (){
        $this->setOutputLev(myOut::OUT_LEVEL_DEBUG);
    }
}
/**
 * End myOut class definition
 */


/**
 * @var myOut $outputObj
 * Object for contain output information (strings) (aka log) 
 * accoding output leval.
 */
$outputObj = new myOut();


/**
 * Include config class of this script
 */
/**
 * @var string $cfg Represented full path to config file for this script
 */
$cfg = dirname(__FILE__)."/xmlHndlConf.class.php";
$outputObj->setOutputStr(
        '<br/>$cfg = "'.$cfg.'"<br/>', 
        myOut::OUT_LEVEL_DEBUG);
$outputObj->setOutputStr("----- -----<br/>", myOut::OUT_LEVEL_DEBUG);

/** 
 * Check existing config file to this script
 */
$outputObj->setOutputStr(
        "<br/>Check existing config file to this script", 
        myOut::OUT_LEVEL_INFO);
if (!file_exists($cfg)){
    $outputObj->setOutputStr(
            "<br/>Can't find config file to this script<br/>", 
            myOut::OUT_LEVEL_ERROR);
    die($outputObj->getOutputStr(myOut::OUT_LEVEL_ERROR));
}
$outputObj->setOutputStr(": OK<br/>", myOut::OUT_LEVEL_INFO);

require_once ($cfg);

/**
 * @var xmlHndlConf $xmlHndlCfg
 * Main config class as set of configuration set (for this script).
 */
$xmlHndlCfg = new xmlHndlConf();
/**
 * Output parameters in main (configuration) object as set (for this script).
 */
foreach ($xmlHndlCfg as $cfg_key => $cfg_value) {
    $outputObj->setOutputStr(
            "\$xmlHndlCfg->{$cfg_key} => \"{$cfg_value}\"<br/>", 
            myOut::OUT_LEVEL_DEBUG);
}
$outputObj->setOutputStr("<br/>----- -----<br/>", myOut::OUT_LEVEL_DEBUG);

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
$outputObj->setOutputStr(
        "<br/>Check existing site config file", 
        myOut::OUT_LEVEL_INFO);
if (!file_exists($xmlHndlCfg->coreConfigPath)){
    $outputObj->setOutputStr(
            "<br/>Can't find site config file<br/>", 
            myOut::OUT_LEVEL_ERROR);
    die($outputObj->getOutputStr(myOut::OUT_LEVEL_ERROR));
}
$outputObj->setOutputStr(": OK<br/>", myOut::OUT_LEVEL_INFO);

/** 
 * Output content from site config file
 */
$outputObj->setOutputStr("<pre>", myOut::OUT_LEVEL_DEBUG);
$outputObj->setOutputStr(
        htmlspecialchars(
                file_get_contents($xmlHndlCfg->coreConfigPath)
            ),
        myOut::OUT_LEVEL_DEBUG);
$outputObj->setOutputStr("</pre>", myOut::OUT_LEVEL_DEBUG);

// Подружаем config MODx
require_once $xmlHndlCfg->coreConfigPath;

// Подружаем основной класс MODx
include_once MODX_CORE_PATH . '/model/modx/modx.class.php';

// Инициализируем класс MODx
$modx= new modX();
$outputObj->setOutputStr(
        "<br/>MODx class initialization: OK<br/>", 
        myOut::OUT_LEVEL_INFO);

//// Инициализируем контекст, если принципиально
// $modx->initialize('mgr');

// Устанавливаем настройки логирования
// Не обязательно
$modx->setLogLevel(modX::LOG_LEVEL_INFO);
$modx->setLogTarget(XPDO_CLI_MODE ? 'ECHO' : 'HTML');

// !!! Обязательно!???
// Подгружаем основной класс-пакер
//$outputObj->setOutputStr(
//        "<br/>loading main class-paker", 
//        myOut::OUT_LEVEL_INFO);
//$modx->addPackage('transport.modPackageBuilder', '', false, true);
//$outputObj->setOutputStr(
//        ": OK<br/>", 
//        myOut::OUT_LEVEL_INFO);

//// Указатель типа базы данных (MySQL / MsSQL и т.п.)
$outputObj->setOutputStr(
        "<br/>Create DB type pointer (manager) (MySQL / MsSQL)", 
        myOut::OUT_LEVEL_INFO);
$manager = $modx->getManager();
if ($manager !== NULL){
    $outputObj->setOutputStr(": OK<br/>", myOut::OUT_LEVEL_INFO);
}

//// Класс-генератор схем
$outputObj->setOutputStr(
        "<br/>Class - schem generation", 
        myOut::OUT_LEVEL_INFO);
$generator = $manager->getGenerator();
if ($generator instanceof xPDOGenerator) {
    $outputObj->setOutputStr(": OK<br/>", myOut::OUT_LEVEL_INFO);
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
//$xml= $generator->writeSchema($Schema, $obj, 'xPDOObject', $tablePrefix ,$restrictPrefix=true );
//$xml = $generator->writeSchema(
//        $xmlHndlCfg->schemaFullPath,
//        $xmlHndlCfg->objName, 
//        'xPDOObject', 
//        $xmlHndlCfg->tablePrefix, 
//        $restrictPrefix=true
//        );

//// Создает классы и мапы (php) по схеме xml
//$generator->parseSchema($Schema, $Path); 

$outputObj->setOutputStr("<br/>Выполнено", myOut::OUT_LEVEL_INFO);
//print $outputObj->getOutputStr(myOut::OUT_LEVEL_ERROR);
//print $outputObj->getOutputStr(myOut::OUT_LEVEL_INFO);
print $outputObj->getOutputStr(myOut::OUT_LEVEL_DEBUG);
