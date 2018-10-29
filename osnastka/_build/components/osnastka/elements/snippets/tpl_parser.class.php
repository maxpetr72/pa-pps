<?php

class tplParser {
    var $template; 
    var $vars       = array(); 
    var $chunks     = array(); 
    var $snippets   = array(); 
    const PREG_ELEMENT_SYMBOL_BEGIN = '/^\[\[/';
    const PREG_ELEMENT_SYMBOL_END = '/\]\]$/';
    const PREG_CHUNK_SYMBOL_BEGIN = '/^\$/';

    function getTpl($tpl_name)
    {
        if(empty($tpl_name) || !file_exists($tpl_name))
        {
          return false;
        }
        else
        {
          $this->template  = file_get_contents($tpl_name);
        }
    }
      
    function setTpl($key,$var)
    {
        $this->vars[$key] = $var;
        $element_str = trim($key);
        if((
            preg_match(self::PREG_ELEMENT_SYMBOL_BEGIN, $element_str)
            == 1 
            ) && ( 
            preg_match(self::PREG_ELEMENT_SYMBOL_END, $element_str)
            == 1
        ))
        {
            // delete begin and end tag
            $element_str = preg_replace(
                    [
                        self::PREG_ELEMENT_SYMBOL_BEGIN,
                        self::PREG_ELEMENT_SYMBOL_END
                    ]
                    , ''
                    , $element_str
                    );
        }
        if(
            preg_match(self::PREG_CHUNK_SYMBOL_BEGIN, $element_str)
            == 1
        )
        {
            // the chunk
            $element_str = preg_replace(self::PREG_CHUNK_SYMBOL_BEGIN
                    , ''
                    , $element_str
                    );
            $this->chunks[$element_str] = $var;
        }
        else 
        {
            // the snippet
            $this->snippets[$element_str] = $var;
        }
    }
      
    function tplParse()
    {
        foreach($this->vars as $find => $replace)
        {
            $this->template = str_replace($find, $replace, $this->template);
        }
    }
}
