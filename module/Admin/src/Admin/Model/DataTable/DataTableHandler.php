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
        $tableSetterClassMap = $this->getInput('datatables_classmap', 1);

        if ( isset($tableSetterClassMap[$tableSetter]) ) {
            
            if (class_exists($tableSetterClassMap[$tableSetter])) {
                $ojectName = $tableSetterClassMap[$tableSetter];
                $object = new $ojectName($this->getInput());

                $this->setVariable('records',           $object->getRecords());
                $this->setVariable('tableTitle',        $object->getTitle());
                $this->setVariable('tableDescription',  $object->getDescription());
                $this->setVariable('columns',           $object->getColumns());
                
                $this->exportVariableAsGlobal($object->getVarToExport());
                
                $this->setTemplate($object->getTemplate());
            }
            
        } else {
            $this->setTemplate('message.phtml');
            $this->setVariables(array(
                    'messageType'   => 'danger',
                    'messageTitle'  => 'Errori verificati',
                    'messageText'   => "Impossibile visualizzare l'elenco dati richiesto",
                )
            );
        }

        return $this->getOutput();
    }
}
