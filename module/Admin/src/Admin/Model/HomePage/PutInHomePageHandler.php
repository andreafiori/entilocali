<?php

namespace Admin\Model\HomePage;

use Application\Model\RouterManagers\RouterManagerAbstract;
use Application\Model\RouterManagers\RouterManagerInterface;

/**
 * Class PutInHomePageHandler
 * @package Admin\Model\HomePage
 */
class PutInHomePageHandler extends RouterManagerAbstract implements RouterManagerInterface
{
    public function setupRecord()
    {
        $this->setVariables(array(
            'configs' => ''
        ));
        $this->setTemplate('homepage/putinhomepage.phtml');

        return $this->getOutput();
    }
}
