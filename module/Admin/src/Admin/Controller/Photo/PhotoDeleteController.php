<?php

namespace Admin\Controller\Photo;

use Application\Controller\SetupAbstractController;

/**
 * TODO: delete thumb, delete image, delete from relations, posts, log opereation
 */
class PhotoUpdateController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $this->layout()->setTemplate($mainLayout);
    }
}