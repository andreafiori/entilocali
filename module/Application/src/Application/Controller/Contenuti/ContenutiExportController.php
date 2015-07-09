<?php

namespace Application\Controller\Contenuti;

use ModelModule\Model\Contenuti\ContenutiFormSearch;
use ModelModule\Model\Contenuti\ContenutiGetter;
use ModelModule\Model\Contenuti\ContenutiGetterWrapper;
use Application\Controller\SetupAbstractController;
use Zend\Session\Container as SessionContainer;
use ModelModule\Model\Export\CsvExportHelper;

/**
 * Generic Contenuti export
 */
class ContenutiExportController extends SetupAbstractController
{
    public function csvAction()
    {
        if ($this->getRequest()->isPost()) {

            $request = $this->getRequest();

            $post = array_merge_recursive(
                $request->getPost()->toArray(),
                $request->getFiles()->toArray()
            );

            $form = new ContenutiFormSearch();
            $form->addSubmitButton();
            $form->setBindOnValidate(false);
            $form->setData($post);

            if ( $form->isValid() ) {

                $sessionContainer = new SessionContainer();

                $sessionContainer->offsetSet('contenutiFormSearch', $post);

                $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

                $wrapper = new ContenutiGetterWrapper(new ContenutiGetter($em));
                $wrapper->setInput(array(
                    'limit' => 1500,
                ));
                $wrapper->setupQueryBuilder();

                $records = $wrapper->getRecords();

                $csvExportHelper = new CsvExportHelper();

                if ( !empty($records) ) {
                    $arrayContent = array();
                    $arrayContent[] = array('Titolo', 'Sottotitolo', 'Testo');
                    foreach($records as $record) {
                        $arrayContent[] = array(
                            $record['titolo'],
                            $record['sommario'],
                            $record['testo'],
                        );
                    }

                    $content = $csvExportHelper->makeCsvLine($arrayContent);

                    $response = $this->getResponse();
                    $response->getHeaders()
                            ->addHeaderLine('Content-Type', 'text/csv')
                            ->addHeaderLine('Content-Disposition', 'attachment; filename="contenuti_'.date("dmYHis").'.csv"')
                            ->addHeaderLine('Accept-Ranges', 'bytes')
                            ->addHeaderLine('Content-Length', strlen($content) );
                    $response->setContent($content);

                    return $response;
                }

            }
        }

        return $this->redirectForUnvalidAccess();
    }

    public function pdfAction()
    {

    }
}