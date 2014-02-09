<?php

namespace Posts\Controller;

use Application\Controller\FrontendControllerAbstract;

/**
 * PhotoController
 * @author Andrea Fiori
 * @since  02 February 2014
 */
class PhotoController extends FrontendControllerAbstract {
	
	/**
	 * TODO: 
	 * 		move, optimize, generalize this procedure. This is only temporary for FossoBandito project!!!
	 * 		the path gallery/photo/json can be better for example
	 * /posts/photo/galleryjson
	 * @return string (JSON)
	 */
    public function galleryjsonAction()
    {
    	$setupManager = $this->generateSetupManagerFromInitializerPlugin();
    	$templateData = $setupManager->getTemplateDataSetter()->getTemplateData();
    	
    	$response = $this->getResponse();
    	$response->setStatusCode(200);
    	
    	$imgpathdir = $templateData['remotelinkWeb'].'public/frontend/projects/fossobandito/gallery/';
    	$response->setContent('{"href":"'.$imgpathdir.'big/photo_01.jpg"},
    	{"href":"'.$imgpathdir.'big/photo_05.jpg"},
    	{"href":"'.$imgpathdir.'big/photo_06.jpg"},
    	{"href":"'.$imgpathdir.'big/photo_07.jpg"},
    	{"href":"'.$imgpathdir.'big/photo_08.jpg"},
    	{"href":"'.$imgpathdir.'big/photo_09.jpg"},
    	{"href":"'.$imgpathdir.'big/photo_10.jpg"},
    	{"href":"'.$imgpathdir.'big/photo_11.jpg"},
    	{"href":"'.$imgpathdir.'big/photo_12.jpg"}');
    	
    	return $response;
    }
}