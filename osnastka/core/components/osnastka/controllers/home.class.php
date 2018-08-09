<?php

/**
 * The home manager controller for Osnastka.
 *
 */
class OsnastkaHomeManagerController extends modExtraManagerController
{
    /** @var Osnastka $Osnastka */
    public $Osnastka;


    /**
     *
     */
    public function initialize()
    {
        $this->Osnastka = $this->modx->getService('Osnastka', 'Osnastka', MODX_CORE_PATH . 'components/osnastka/model/');
        parent::initialize();
    }


    /**
     * @return array
     */
    public function getLanguageTopics()
    {
        return ['osnastka:default'];
    }


    /**
     * @return bool
     */
    public function checkPermissions()
    {
        return true;
    }


    /**
     * @return null|string
     */
    public function getPageTitle()
    {
        return $this->modx->lexicon('osnastka');
    }


    /**
     * @return void
     */
    public function loadCustomCssJs()
    {
        $this->addCss($this->Osnastka->config['cssUrl'] . 'mgr/main.css');
        $this->addJavascript($this->Osnastka->config['jsUrl'] . 'mgr/osnastka.js');
        $this->addJavascript($this->Osnastka->config['jsUrl'] . 'mgr/misc/utils.js');
        $this->addJavascript($this->Osnastka->config['jsUrl'] . 'mgr/misc/combo.js');
        $this->addJavascript($this->Osnastka->config['jsUrl'] . 'mgr/widgets/items.grid.js');
        $this->addJavascript($this->Osnastka->config['jsUrl'] . 'mgr/widgets/items.windows.js');
        $this->addJavascript($this->Osnastka->config['jsUrl'] . 'mgr/widgets/home.panel.js');
        $this->addJavascript($this->Osnastka->config['jsUrl'] . 'mgr/sections/home.js');

        $this->addHtml('<script type="text/javascript">
        Osnastka.config = ' . json_encode($this->Osnastka->config) . ';
        Osnastka.config.connector_url = "' . $this->Osnastka->config['connectorUrl'] . '";
        Ext.onReady(function() {MODx.load({ xtype: "osnastka-page-home"});});
        </script>');
    }


    /**
     * @return string
     */
    public function getTemplateFile()
    {
        $this->content .= '<div id="osnastka-panel-home-div"></div>';

        return '';
    }
}