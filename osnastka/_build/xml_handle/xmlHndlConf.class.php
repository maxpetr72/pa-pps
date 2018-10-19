<?php

/*******************************************************/
/* Конфиги нашей схемы */
/*******************************************************/
/*
 * Container of configuration parametrs to xml-schem script.
 * 
 * This is the file to spesify configuration parametrs for script, wich manage 
 * xml-schem from/to existing table in DB.
 * 
 * This file use MODX Revolution.
 *
 */


/**
 * Include xmlHndlLog class as log of this script
 */
/**
 * @var string $xmlHndlMyLogPath Represented full path to log class file 
 * for this script
 */
$xmlHndlLogPath = dirname(__FILE__)."/xmlHndlLog.class.php";

/** 
 * Check existing path to log class file for this script
 */
if (!file_exists($xmlHndlLogPath)){
    die("<br/>Can't find log file for this script<br/>");
}

require_once ($xmlHndlLogPath);
unset($xmlHndlLogPath);

/**
 * Description of xmlHndlConf.
 * 
 * Main config class as set of configuration set.
 * 
 * @package xmlhandle
 */
class xmlHndlConf {
    /**
     * Many (if not all) parametrs assing when object is created 
     * (in function __construct()).
     * Значение многих (если не всех) параметров устанавливается 
     * при создании объекта (в функции-конструкторе).
     */

    /**
     * @var xmlHndlLog $myLog
     * Main log class as set of output strings (for this script).
     * Object for contain output information (strings) (aka log) 
     * accoding output leval.
     */
    public $log = null;

    /**
     * @var string $coreConfigPath The parameter represented full path to 
     * site config file in core folder. 
     * Полный путь к основному файлу-конфигу сайта или самим придется 
     * прописывать все основные настройки
     */
    public $coreConfigPath = '';

    /**
     * @var string $objName The parameter represented name of object seved 
     * in DB. 
     * Same will be named Class, when call function $modx->addPackage()
     * {@example 'Osnastka'}
     * Имя Класса. 
     * Так будет потом называться Класс при вызове $modx->addPackage()
     */
    public $objName = '';
     
    /**
     * @var string $objNameLowCase The parameter represented name (in low case) 
     * of object seved in DB. 
     * Имя Класса (в нижнем регистре).
     * 
     * ($objNameLowCase = strtolower($objName);)
     */
    public $objNameLowCase = '';
     
    /**
     * @var string $objNameCorePath The parameter represented full path to 
     * "core" folder of this object (component). 
     * Полный путь к каталогу "core" данного объекта (компонента).
     */
    public $objNameCorePath = '';
     
    /**
     * @var string $objNameAssetsPath The parameter represented full path to 
     * "assets" folder of this object (component). 
     * Полный путь к каталогу "assets" данного объекта (компонента).
     */
    public $objNameAssetsPath = '';
     
    /**
     * @var string $tablePrefix The parameter represented teble name prefix 
     * to select tables from DB. 
     * If the prefix does not differ from the system prefix, then you may not 
     * specify it at all. 
     * Unfortunately, xPDO does not allow us to list the names of specific 
     * tables that we need, but it allows us to filter out only the prefix.
     * {@example 'papps_osn_'}
     * Префикс таблиц. 
     * Если префикс не отличается от системного, то можно вообще не указывать. 
     * К сожалению, xPDO при генерации не позволяет перечислять имена 
     * конкретных таблиц, которые нам нужны, а позволяет отсеять только 
     * по префиксу.
     */
    public $tablePrefix = '';
     
    /**
     * @var string $schemaPath The parameter represented a folder where 
     * the XML schema and all files of the created object will be written. 
     * The path to the class files you will then write in the method call
     * $modx->addPackage(); 
     * Папка, где будет записана XML-схема и все файлы создаваемого объекта
     * Путь к файлам класса вы будете потом прописывать 
     * в вызове метода $modx->addPackage(); 
     * 
     * ($schemaPath = dirname(__FILE__).'/model/';)
     */
    public $schemaPath = '';
                
    /**
     * @var string $schemaPathMode The parameter represented a mode (in octets 
     * format) folder where the XML schema and all files of the created object 
     * will be written. This parametr use if need to create folder. 
     * Значение режима (в восьмеричном формате) папки, где будет записана 
     * XML-схема и все файлы создаваемого объекта. Параметр используется если 
     * необходимо создать папку. 
     */
    public $schemaPathMode = '';
                
    /**
     * @var boolean $schemaPathIsRecurs The parameter represented is need to 
     * create all folders in path to XML schema. 
     * This parametr use if need to create folder. 
     * Надо ли создавать все папки в пути где будет записана XML-схема. 
     * Параметр используется если необходимо создать папку. 
     */
    public $schemaPathIsRecurs = '';
                
    /**
     * @var string $schemaFullPath The parameter represented full path, 
     * of schema file. 
     * Полное имя файла XML-схемы.
     * 
     * ($schemaFullPath = $schemaPath.$objNameLowcase.'.mysql.schema.xml';)
     */
    public $schemaFullPath = '';
                
    /**
     * @var string $baseClass The parameter represented base class in 
     * xml-schema file. From this class we derived our model.
     * Базовый класс в xml-schema фале. От этого класса мы наследуем нашу 
     * модель.
     * 
     * ($baseClass = 'xPDOObject';)
     */
    public $baseClass = '';
                
    /**
     * @var boolean $restrictPrefix The parameter represented is need to 
     * restricted prefix in writeSchema() function or not.
     * Надо ли ограничиваться префиксом при вызове функции writeSchema() или 
     * нет. 
     */
    public $restrictPrefix = '';
                
    /**
     * Construct a new xmlHndlConf instance.
     *
     * @return xmlHndlConf A new xmlHndlConf instance.
     */
    public function __construct() {
        $this->log = new xmlHndlLog();
        $this->log->setOutputLev(xmlHndlLog::OUT_LEVEL_INFO);
        
        $this->objName = 'Osnastka';
        $this->objNameLowCase = strtolower($this->objName);
        
        $siteSystemPath = 
                "e:/_maxp_private/YandexDisk/_maxp_private/my_sites_prj/"
                ."_my_sites/pa-pps.loc/";
        $siteCorePath = 
                $siteSystemPath
                ."core_papps/";
        $sitePublicPath = 
                $siteSystemPath
                ."public_html/";
        $siteAssetsPath = 
                $sitePublicPath
                ."assets/";
        
        $this->coreConfigPath = 
                $siteCorePath
                ."config/config.inc.php";
        
        $this->objNameCorePath = 
                $sitePublicPath
                .$this->objName
                ."/core/";
        $this->objNameAssetsPath = 
                $sitePublicPath
                .$this->objName
                ."/assets/";
        unset(
                $siteAssetsPath, 
                $siteCorePath,
                $sitePublicPath,
                $siteSystemPath
                );
        
        $this->tablePrefix = 'papps_osn_';
        
        $this->schemaPath = dirname(__FILE__).'/model/';
        $this->schemaPathMode = "0777";
        $this->schemaPathIsRecurs = TRUE;
        $this->schemaFullPath = $this->schemaPath.$this->objNameLowCase
                .'.mysql.schema.xml';
        
        $this->baseClass = 'xPDOObject';
        $this->restrictPrefix = TRUE;
    }
}
