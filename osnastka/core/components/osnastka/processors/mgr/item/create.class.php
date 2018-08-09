<?php

class OsnastkaItemCreateProcessor extends modObjectCreateProcessor
{
    public $objectType = 'OsnastkaItem';
    public $classKey = 'OsnastkaItem';
    public $languageTopics = ['osnastka'];
    //public $permission = 'create';


    /**
     * @return bool
     */
    public function beforeSet()
    {
        $name = trim($this->getProperty('name'));
        if (empty($name)) {
            $this->modx->error->addField('name', $this->modx->lexicon('osnastka_item_err_name'));
        } elseif ($this->modx->getCount($this->classKey, ['name' => $name])) {
            $this->modx->error->addField('name', $this->modx->lexicon('osnastka_item_err_ae'));
        }

        return parent::beforeSet();
    }

}

return 'OsnastkaItemCreateProcessor';