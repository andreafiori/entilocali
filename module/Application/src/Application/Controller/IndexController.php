<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;

use Config\Model\Config;

/**
 * 
 *  SELECT id, language, abbrev1, abbrev3 FROM languages WHERE active = '1' 
 *  ... and THEN select labels: 
    SELECT SQL_CALC_FOUND_ROWS language, abbrev1, abbrev3, l.id, l.id AS idlabel, labelname, labelvalue FROM languages l, languages_labels ll WHERE active = '1' AND l.id = ll.riflang AND abbrev1 = 'it' 
     
 * Home page controller
 * @author Andrea Fiori
 * @since  04 December 2013
 */
class IndexController extends AbstractActionController
{
	private $configTable;
	
    /**
     * @return array with viewModel object lets return an HTTP 200 status on ZfTool
     */
    public function indexAction()
    {
    	print_r( $this->getResponse() );
    	
    	$configTable = $this->getConfigTable();
    	$configFromDb = $configTable->fetchAll(
    			array(
    				'rifchannel' => array(1, 0),
    				'riflanguage' => array(1, 0),
    				'isadmin' => 0
    			)
    	);
    	
    	$this->layout('frontend/projects/fossobandito/templates/default/layout.phtml');
    	return array("config" => $configFromDb);
    }
    
    	/**
    	 * @return ConfigTable $configTable
    	 */
    	private function getConfigTable()
    	{
    		if (!$this->configTable) {
    			$this->configTable = $this->getServiceLocator()->get('Config\Model\ConfigTable');
    		}
    		return $this->configTable;
    	}
}
