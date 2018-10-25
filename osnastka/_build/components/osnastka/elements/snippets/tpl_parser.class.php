<?php

class tplParser {
    //put your code here
    var $vars     = array(); 
    var $template; 

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
      }
      
    function tplParse()
      {
         foreach($this->vars as $find => $replace)
             {
               $this->template = str_replace($find, $replace, $this->template);
             }
      }
  }
