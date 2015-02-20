<?php

namespace Admin\Model\Config;

use Application\Model\RouterManagers\RouterManagerAbstract;
use Application\Model\RouterManagers\RouterManagerInterface;

/**
 * @author Andrea Fiori
 * @since  19 February 2015
 */
class ConfigEditHandler  extends RouterManagerAbstract implements RouterManagerInterface
{
    public function setupRecord()
    {
        $wrapper = new ConfigGetterWrapper( new ConfigGetter($this->getInput('entityManager',1)) );
        $wrapper->setInput(array());
        $wrapper->setupQueryBuilder();

        $this->setVariables(array(
            'configs' => $wrapper->getRecords()
        ));
        $this->setTemplate('config-edit/config-edit.phtml');

        return $this->getOutput();
    }
}
