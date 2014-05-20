<?php

namespace Admin\Model\DataTable;

use Application\Model\RouterManagers\RouterManagerAbstract;
use Application\Model\RouterManagers\RouterManagerInterface;

/**
 * @author Andrea Fiori
 * @since  18 May 2013
 */
class DataTableHandler extends RouterManagerAbstract implements RouterManagerInterface
{
    public function setupRecord()
    {
        $tableSetter = $this->getInput('tablesetter', 1);
        $tableSetterClassMap = array(
            'albo-pretorio'               => 'Admin\Model\AlboPretorio\AlboPretorioTable',
            'amministrazione-trasparente' => 'Admin\Model\AmministrazioneTrasparente\AmministrazioneTrasparenteDataTable',
            'assistenza'                  => 'Admin\Model\Assistenza\AssistenzaDataTable',
            'contatti'                    => 'Admin\Model\Contatti\ContattiTable',
            'faq'                         => 'Admin\Model\Faq\FaqTable',
            'newsletter'                  => 'Admin\Model\Newsletter\NewsletterTable',
            'posts'                       => 'Admin\Model\Posts\PostsDataTable',
            'stato-civile'                => 'Admin\Model\StatoCivile\StatoCivileDataTable',
        );

        if ( isset($tableSetterClassMap[$tableSetter]) ) {
            if (class_exists($tableSetterClassMap[$tableSetter])) {
                $ojectName = $tableSetterClassMap[$tableSetter];
                $object = new $ojectName($this->getInput());
                
                $this->setVariable('tableTitle',        $object->getTitle());
                $this->setVariable('tableDescription',  $object->getDescription());
                $this->setVariable('columns',           $object->getColumns());
                $this->setVariable('records',           $object->getRecords());
                
                $this->setTemplate($object->getTemplate());
            }
        }

        return $this->getOutput();
    }
}
