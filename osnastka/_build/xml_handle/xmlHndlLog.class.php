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
class xmlHndlLog {
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
        xmlHndlLog::OUT_LEVEL_ERROR => "",
        xmlHndlLog::OUT_LEVEL_INFO => "",
        xmlHndlLog::OUT_LEVEL_DEBUG => "",
    );
    
    /**
     * @var mixed $curOutLev Set current output level
     */
    private $curOutLev = xmlHndlLog::OUT_LEVEL_DEBUG;
    
    /**
     * Set current output level
     * 
     * @return void
     */
    public function setOutputLev ($outLev = xmlHndlLog::OUT_LEVEL_ERROR){
        /* @var $curOutLev string */
        $this->curOutLev = $outLev;
    }
    
    /**
     * Get current output level
     * 
     * @return int The current output level
     */
    public function getOutputLev (){
        return $this->curOutLev;
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
            $outLev = xmlHndlLog::OUT_LEVEL_DEBUG
            ){
        if (!isset($str2out) || $str2out == "" || $str2out == NULL){
            return;
        }
        if (!isset($outLev) || !array_key_exists($outLev, $this->outputStr)){
            return;
        }
        if (isset($outLev)){
            if ($outLev == xmlHndlLog::OUT_LEVEL_ERROR){
                $this->outputStr[xmlHndlLog::OUT_LEVEL_ERROR] .= $str2out;
                $this->outputStr[xmlHndlLog::OUT_LEVEL_INFO] .= $str2out;
                $this->outputStr[xmlHndlLog::OUT_LEVEL_DEBUG] .= $str2out;
            }
            if ($outLev == xmlHndlLog::OUT_LEVEL_INFO){
                $this->outputStr[xmlHndlLog::OUT_LEVEL_INFO] .= $str2out;
                $this->outputStr[xmlHndlLog::OUT_LEVEL_DEBUG] .= $str2out;
            }
            if ($outLev == xmlHndlLog::OUT_LEVEL_DEBUG){
                $this->outputStr[xmlHndlLog::OUT_LEVEL_DEBUG] .= $str2out;
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
            $outLev = xmlHndlLog::OUT_LEVEL_DEBUG
            ){
        if (!isset($outLev) || !array_key_exists($outLev, $this->outputStr)){
            return "";
        }
        if (isset($outLev)) {
            if($outLev == xmlHndlLog::OUT_LEVEL_ERROR){
                return $this->outputStr[xmlHndlLog::OUT_LEVEL_ERROR];
            }
            if($outLev == xmlHndlLog::OUT_LEVEL_INFO){
                return $this->outputStr[xmlHndlLog::OUT_LEVEL_INFO];
            }
            if($outLev == xmlHndlLog::OUT_LEVEL_DEBUG){
                return $this->outputStr[xmlHndlLog::OUT_LEVEL_DEBUG];
            }
        }
    }
    
    /**
     * Constract a new xmlHndlLog instance
     */
    public function __construct (){
        $this->setOutputLev(xmlHndlLog::OUT_LEVEL_DEBUG);
    }
}
/**
 * End xmlHndlLog class definition
 */
