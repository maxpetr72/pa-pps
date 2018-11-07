<?php

class tplParser {
    var $template; 
    var $vars       = array(); 
    var $chunks     = array(); 
    var $snippets   = array(); 
    const PREG_ELEMENT_SYMBOL_BEGIN = '\[\[';
    const PREG_ELEMENT_SYMBOL_END = '\]\]';
    const PREG_CHUNK_SYMBOL_BEGIN = '\$';
//    var $elementSymbolBegin    = array(
//        'chunk' => '[[$',
//        'snippet' => '[[',
//    );
//    var $elementSymbolEnd    = array(
//        'chunk' => ']]',
//        'snippet' => ']]',
//    );
//    var $chank_begin = '[[$';
//    var $snippets_begin = '[[';
//    var $elements_end   = ']]';

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
//        if(strpos($element_str, $this->chank_begin) == 0)
//        {
//            // the chank
//            $element_str = str_replace($this->chank_begin, '', $element_str);
//            $element_str = str_replace($this->elements_end, '', $element_str);
//            $this->chanks[$element_str] = $var;
//        }
//        elseif(strpos($element_str, $this->snippets_begin) == 0)
//        {
//            // the snippet
//            $element_str = str_replace($this->snippets_begin, '', $element_str);
//            $element_str = str_replace($this->elements_end, '', $element_str);
//            $this->snippets[$element_str] = $var;
//        }
////        
//        $idxName = 'chunk';
//        if(strpos($element_str, $this->elementSymbolBegin[$idxName]) == 0)
//        {
//            // the chank
//            $element_str = str_replace(
//                    $this->elementSymbolBegin[$idxName], 
//                    '', 
//                    $element_str
//                    );
//            $element_str = str_replace(
//                    $this->elementSymbolEnd[$idxName], 
//                    '', 
//                    $element_str
//                    );
//            $this->chunks[$element_str] = $var;
//        }
//        else
//        {
//            $idxName = 'snippet';
//            if(strpos($element_str, $this->elementSymbolBegin['snippet']) == 0)
//            {
//                // the snippet
//                $element_str = str_replace(
//                        $this->elementSymbolBegin[$idxName], 
//                        '', 
//                        $element_str
//                        );
//                $element_str = str_replace(
//                        $this->elementSymbolEnd[$idxName], 
//                        '', 
//                        $element_str
//                        );
//                $this->snippets[$element_str] = $var;
//            }
//        }
        $pregMatchBeg = preg_match(self::PREG_ELEMENT_SYMBOL_BEGIN
                , $element_str
                );
        $pregMatchEnd = preg_match(self::PREG_ELEMENT_SYMBOL_END
                , $element_str
                );
        if(($pregMatchBeg == 1) && ($pregMatchEnd == 1)){
            // delete begin and end tag
            $element_str = preg_replace(self::PREG_ELEMENT_SYMBOL_BEGIN
                    , ''
                    , $element_str
                    );
            $element_str = preg_replace(self::PREG_ELEMENT_SYMBOL_END
                    , ''
                    , $element_str
                    );
        }
        unset($pregMatchBeg, $pregMatchEnd);
        $pregMatch = preg_match(self::PREG_CHUNK_SYMBOL_BEGIN
                , $element_str
                );
        if($pregMatch == 1){
            // the chunk
            $element_str = preg_replace(self::PREG_CHUNK_SYMBOL_BEGIN
                    , ''
                    , $element_str
                    );
            $this->chunks[$element_str] = $var;
        }
        else {
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
