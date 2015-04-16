<?php

namespace Application\Controller\Faq;

use Application\Controller\SetupAbstractController;

/**
 * @author Andrea Fiori
 * @since  15 April 2015
 */
class FaqController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeFrontendWebsite();

        $this->layout()->setVariables(array(
            'templatePartial' => 'faq/faq.phtml'
        ));

        $this->layout()->setTemplate($mainLayout);
    }
}