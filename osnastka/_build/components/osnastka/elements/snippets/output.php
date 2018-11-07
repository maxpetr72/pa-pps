<?php

$tplParserPath = dirname(__FILE__) ."/tpl_parser.class.php";
$tplPath = dirname(__DIR__)."/templates/main_osn.tpl";
$chunkPath = dirname(__DIR__)."/chunk";
//$chunkPathTitle = $chunkPath."/title.ch.tpl";
//$chunkPathCssPath = $chunkPath."/cssPath.ch.tpl";
//$chunkPathContent = $chunkPath."/content.ch.tpl";
require($tplParserPath);    // подключаем скрипт-обработчик

/** 
 * @var tplParser $tplParser  
 */
$tplParser = new tplParser();
$tplParser->getTpl($tplPath);   // считываем данные из шаблона 

//$title = "TODO supply a title";
//$cssPass = "../../css/main_osn.css";
//$content = "Just an example";

$tplParser->getChunk('title');
$tplParser->getChunk('cssPath');
$tplParser->getChunk('content');
$tplParser->getSnippet('title');
$tplParser->getSnippet('cssPath');
$tplParser->getSnippet('content');

//// заменяем переменные из шаблона на полученные данные
//$tplParser->setTpl('[[$title]]', $title);
//$tplParser->setTpl('[[$cssPath]]', $cssPass);
//$tplParser->setTpl('[[$content]]', $content);
//$tplParser->setTpl('[[title]]', $title);
//$tplParser->setTpl('[[cssPath]]', $cssPass);
//$tplParser->setTpl('[[content]]', $content);

$tplParser->tplParse(); // Собираем страничку

echo $tplParser->template; // Выводим страничку
