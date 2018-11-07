<?php

class tplParser {
    var $template; 
    var $fileContent; 
//    var $vars       = array(); 
    var $Paths      = array(); 
    var $chunks     = array(); 
    var $snippets   = array(); 
    const STR_ELEMENT_SYMBOL_BEGIN = '[[';
    const STR_ELEMENT_SYMBOL_END = ']]';
    const STR_CHUNK_SYMBOL_BEGIN = '$';
    const PREG_ELEMENT_SYMBOL_BEGIN = '/^\[\[/';
    const PREG_ELEMENT_SYMBOL_END = '/\]\]$/';
    const PREG_CHUNK_SYMBOL_BEGIN = '/^\$/';

    function getFile($file_name)
    {
        if(empty($file_name) || !file_exists($file_name))
        {
          return false;
        }
        else
        {
          $this->fileContent  = file_get_contents($file_name);
        }
    }
      
    function getTpl($tpl_name)
    {
        $this->getFile($tpl_name);
        if(empty($this->fileContent))
        {
            return false;
        }
        else
        {
            $this->template  = $this->fileContent;
            $this->pickElements();
            $this->fileContent = NULL;
        }
    }
    
    private function pickElements() 
    {
        if(empty($this->fileContent))
        {
            return false;
        }
        else 
        {
            $strLen = array(
                'elBeg' => strlen(self::STR_ELEMENT_SYMBOL_BEGIN),
                'elEnd' => strlen(self::STR_ELEMENT_SYMBOL_END),
                'chBeg' => strlen(self::STR_CHUNK_SYMBOL_BEGIN),
                'fileContent' => strlen($this->fileContent),
            );
            $strposBeg = 
                strpos($this->fileContent, 
                self::STR_ELEMENT_SYMBOL_BEGIN);
            if($strposBeg !== false)
            {
                $curStrpos = $strposBeg; 
                while (
                    $curStrpos < $strLen['fileContent'] 
                )
                {
                    $strposEnd = 
                        strpos($this->fileContent, 
                            self::STR_ELEMENT_SYMBOL_END, 
                            $strposBeg);
                    if($strposEnd !== false)
                    {
                        if(substr($this->fileContent, 
                            $strposBeg + $strLen['elEnd'], 
                            $strLen['chBeg'])
                            === self::STR_CHUNK_SYMBOL_BEGIN
                        )
                        {
                            //chunk
                            $substr_start = 
                                $strposBeg 
                                + $strLen['elBeg'] 
                                + $strLen['chBeg'];
                            $chunk_name = substr($this->fileContent, 
                                $substr_start, 
                                $strposEnd - $substr_start
                                );
                            $this->elementAdd($chunk_name, '', 'chunk');
                        }
                        else 
                        {
                            //snippet
                            $substr_start = 
                                $strposBeg 
                                + $strLen['elBeg'];
                            $snippet_name = substr($this->fileContent, 
                                    $substr_start, 
                                    $strposEnd - $substr_start
                                    );
                            $this->elementAdd($snippet_name, '', 'snippet');
                        }
                    }
                    //loop increment
                    //$curStrpos++;
                    $curStrpos = $strposEnd + $strLen['elEnd'];
                    $strposBeg = 
                        strpos($this->fileContent, 
                                self::STR_ELEMENT_SYMBOL_BEGIN,
                                $curStrpos);
                    if($strposBeg === false)
                    {
                        return;
                    }
                }
            }
        }
    }
    
    private function elementAdd(
            $elementName, 
            $elementVal = '', 
            $elementType = 'chunk'
    )
    {
        if(empty($elementName))
        {
            return;
        }
        if(($elementType == 'chunk') || ($elementType == 'ch'))
        {
            if (!array_key_exists($elementName, $this->chunks))
            {
                ////$this->snippets[$snippet_name] = '';
                //$this->chunks[$elementName] = $elementVal;
                $this->setChunk($elementName, $elementVal);
            }
        }
        elseif (($elementType == 'snippet') || ($elementType == 'sn'))
        {
            if (!array_key_exists($elementName, $this->snippets))
            {
                ////$this->snippets[$snippet_name] = '';
                //$this->snippets[$elementName] = $elementVal;
                $this->setSnippet($elementName, $elementVal);
            }
        }
        else
        {
            //strange choise
            return false;
        }
    }
            
    function getChunk($chunk_name)
    {
        $this->getFile($this->Paths['chunks'].$chunk_name.'.ch.tpl');
        if(empty($this->fileContent))
        {
          return false;
        }
        else
        {
          $this->chunks[$chunk_name]  = $this->fileContent;
          $this->pickElements();
          $this->fileContent = NULL;
        }
    }
      
    function getSnippet($snippet_name)
    {
        $this->getFile($this->Paths['snippets'].$snippet_name.'.php');
        if(empty($this->fileContent))
        {
          return false;
        }
        else
        {
          $this->snippets[$snippet_name]  = $this->fileContent;
          $this->pickElements();
          $this->fileContent = NULL;
        }
    }
      
    function setChunk($key,$var)
    {
//        $this->vars[$key] = $var;
        $element_str = trim($key);
        $this->chunks[$element_str] = $var;
    }
      
    function setSnippet($key,$var)
    {
//        $this->vars[$key] = $var;
        $element_str = trim($key);
        $this->snippets[$element_str] = $var;
    }
      
    function setTpl($key,$var)
    {
//        $this->vars[$key] = $var;
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
            $this->setChunk($element_str, $var);
        }
        else 
        {
            // the snippet
            $this->setSnippet($element_str, $var);
        }
    }
      
//    function setTpl($key,$var)
//    {
//        $this->vars[$key] = $var;
//        $element_str = trim($key);
//        if((
//            preg_match(self::PREG_ELEMENT_SYMBOL_BEGIN, $element_str)
//            == 1 
//            ) && ( 
//            preg_match(self::PREG_ELEMENT_SYMBOL_END, $element_str)
//            == 1
//        ))
//        {
//            // delete begin and end tag
//            $element_str = preg_replace(
//                    [
//                        self::PREG_ELEMENT_SYMBOL_BEGIN,
//                        self::PREG_ELEMENT_SYMBOL_END
//                    ]
//                    , ''
//                    , $element_str
//                    );
//        }
//        if(
//            preg_match(self::PREG_CHUNK_SYMBOL_BEGIN, $element_str)
//            == 1
//        )
//        {
//            // the chunk
//            $element_str = preg_replace(self::PREG_CHUNK_SYMBOL_BEGIN
//                    , ''
//                    , $element_str
//                    );
//            $this->chunks[$element_str] = $var;
//        }
//        else 
//        {
//            // the snippet
//            $this->snippets[$element_str] = $var;
//        }
//    }
//      
    function chunkParse()
    {
        //chanks
        foreach($this->chunks as $ch_name => $ch_val)
        {
            $find = 
                self::STR_ELEMENT_SYMBOL_BEGIN 
                . self::STR_CHUNK_SYMBOL_BEGIN 
                . $ch_name 
                . self::STR_ELEMENT_SYMBOL_END;
            $this->template = str_replace($find, $ch_val, $this->template);
        }
    }
      
    function snippetParse()
    {
        //snippets
        foreach($this->snippets as $sn_name => $sn_val)
        {
            $find = 
                self::STR_ELEMENT_SYMBOL_BEGIN 
                . $sn_name 
                . self::STR_ELEMENT_SYMBOL_END;
            $this->template = str_replace($find, $sn_val, $this->template);
        }
    }
      
    function tplParse()
    {
        //chanks
        $this->chunkParse();
        //snippets
        $this->snippetParse();
    }
      
//    function tplParse()
//    {
//        foreach($this->vars as $find => $replace)
//        {
//            $this->template = str_replace($find, $replace, $this->template);
//        }
//    }
//      
    function __construct()
    {
        $this->Paths['elements'] = dirname(dirname(__FILE__));
        $this->Paths['chunks'] = 
            $this->Paths['elements'] . "/chunks/";
        $this->Paths['snippets'] = 
            $this->Paths['elements'] . "/snippets/";
        $this->Paths['templates'] = 
            $this->Paths['elements'] . "/templates/";
    }
}
