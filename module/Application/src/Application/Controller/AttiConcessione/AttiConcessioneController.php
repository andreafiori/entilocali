<?php

namespace Application\Controller\AttiConcessione;

use Admin\Model\AttiConcessione\AttiConcessioneControllerHelper;
use Admin\Model\AttiConcessione\AttiConcessioneGetter;
use Admin\Model\AttiConcessione\AttiConcessioneGetterWrapper;
use Admin\Model\Users\Settori\UsersSettoriGetter;
use Admin\Model\Users\Settori\UsersSettoriGetterWrapper;
use Application\Controller\SetupAbstractController;
use Application\Model\AttiConcessione\AttiConcessioneFormSearch;
use Application\Model\NullException;

/**
 * @author Andrea Fiori
 * @since  15 April 2015
 */
class AttiConcessioneController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeFrontendWebsite();

        $page = $this->params()->fromRoute('page');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $templateDir = $this->layout()->getVariable('templateDir');

        $basicLayout = $this->layout()->getVariable('atti_concessione_basiclayout');

        try{
            $helper = new AttiConcessioneControllerHelper();
            $helper->setAttiConcessioneGetterWrapper( new AttiConcessioneGetterWrapper(new AttiConcessioneGetter($em)) );
            $helper->setupYearsRecords( array(
                'fields' => 'DISTINCT(atti.anno) AS year',
                'orderBy' => 'atti.id DESC'
            ),
                $page,
                null
            );
            $helper->setAttiConcessioneGetterWrapper( new AttiConcessioneGetterWrapper(new AttiConcessioneGetter($em)) );
            $helper->setupAttiConcessioneGetterWrapperWithPaginator(
                array('orderBy' => 'atti.id DESC', 'attivo' => 1),
                $page,
                null
            );
            $helper->setUsersSettoriGetterWrapper( new UsersSettoriGetterWrapper(new UsersSettoriGetter($em)) );
            $helper->setupSettoriRecords( array('orderBy' => 'settore.nome') );

            $settoriForDropDown = $helper->getUsersSettoriRecords();

            $yearsForDropdown = $helper->formatYears( $helper->getYearsRecords() );

            $wrapperArticoli = $helper->getAttiConcessioneGetterWrapperWithPaginator();

            $articoliRecords = $wrapperArticoli->setupRecords();

            $form = new AttiConcessioneFormSearch();
            $form->addAnno($yearsForDropdown);
            $form->addMainElements();
            $form->addUfficio($settoriForDropDown);
            $form->addSubmitSearchButton();

            $this->layout()->setVariables(array(
                'records'                       => !empty($articoliRecords) ? $articoliRecords : null,
                'form'                          => $form,
                'paginator'                     => $wrapperArticoli->getPaginator(),
                'paginator_total_item_count'    => $wrapperArticoli->getPaginator()->getTotalItemCount(),
                'templatePartial'               => 'atti-concessione/atti-concessione.phtml',
            ));

        } catch(NullException $e) {
            $this->layout()->setVariables(array(
                'messageType'                   => 'warning',
                'messageText'                   => $e->getMessage(),
                'templatePartial'               => 'atti-concessione/atti-concessione.phtml',
            ));
        }

        $this->layout()->setTemplate(isset($basicLayout) ? $templateDir.$basicLayout : $mainLayout);
    }
}