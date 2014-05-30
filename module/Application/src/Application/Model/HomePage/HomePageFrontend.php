<?php

namespace Application\Model\HomePage;

use Application\Model\RouterManagers\RouterManagerAbstract;
use Application\Model\RouterManagers\RouterManagerInterface;

/**
 * @author Andrea Fiori
 * @since  23 May 2014
 */
class HomePageFrontend extends RouterManagerAbstract implements RouterManagerInterface
{
    public function setupRecord()
    {
        $this->setTemplate(parent::defaultFrontendTemplate);
        
        $this->setVariable('homeRecorders', array(
           1 => array( array("id"=>1, 'titolo' => 'Etichetta in home', 'descrizione' => 'Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.'), array("id"=>1, 'titolo' => 'Etichetta in home', 'descrizione' => 'Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.'), array("id"=>1, 'titolo' => 'Etichetta in home', 'descrizione' => 'Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.') ),
           4 => array( array("id"=>1, 'titolo' => 'Etichetta in home', 'descrizione' => 'Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.'), array("id"=>1, 'titolo' => 'Etichetta in home', 'descrizione' => 'Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.'), array("id"=>1, 'titolo' => 'Etichetta in home', 'descrizione' => 'Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.') ),
        ));
        
        return $this->getOutput();
    }
}
