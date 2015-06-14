<?php

namespace Application\Controller\StatoCivile;

use ModelModule\Model\StatoCivile\StatoCivileFormSearch;
use DOMPDFModule\View\Model\PdfModel;
use ModelModule\Model\StatoCivile\StatoCivileGetter;
use ModelModule\Model\StatoCivile\StatoCivileGetterWrapper;
use Application\Controller\SetupAbstractController;
use Zend\Session\Container as SessionContainer;
use ModelModule\Model\Export\CsvExportHelper;

/**
 * Export after a form POST search request
 */
class StatoCivileExportController extends SetupAbstractController
{
    /**
     * CSV export
     *
     * @return \Zend\Http\Response|\Zend\Stdlib\ResponseInterface
     * @throws \ModelModule\Model\NullException
     */
    public function csvAction()
    {
        if ($this->getRequest()->isPost()) {

            $request = $this->getRequest();

            $post = array_merge_recursive(
                $request->getPost()->toArray(),
                $request->getFiles()->toArray()
            );

            $form = new StatoCivileFormSearch();
            $form->setBindOnValidate(false);
            $form->setData($post);

            if ( $form->isValid() ) {

                $sessionContainer = new SessionContainer();
                $sessionContainer->offsetSet('statoCivileFormSearch', $post);

                $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

                $wrapper = new StatoCivileGetterWrapper(new StatoCivileGetter($em));
                $wrapper->setInput(array(
                    'numero'        => isset($post['numero']) ? $post['numero'] : null,
                    'anno'          => isset($post['anno']) ? $post['anno'] : null,
                    'sezioneId'     => isset($post['sezione']) ? $post['sezione'] : null,
                    'noScaduti'     => isset($post['expired']) ? $post['expired'] : null,
                    'textSearch'    => isset($post['testo']) ? $post['testo'] : null,
                    'orderBy'       => 'sca.id DESC',
                    'limit'         => 1500,
                ));

                $wrapper->setupQueryBuilder();
                $records = $wrapper->getRecords();
                if ( !empty($records) ) {
                    $arrayContent = array();
                    $arrayContent[] = array('Titolo', 'Numero \ Anno', 'Inserito il', 'Scadenza');
                    foreach($records as $record) {
                        $arrayContent[] = array(
                            $record['titolo'],
                            $record['progressivo'].' / '.$record['anno'],
                            $record['data']->format("d-m-Y"),
                            $record['scadenza']->format("d-m-Y"),
                        );
                    }

                    $csvExportHelper = new CsvExportHelper();
                    $content = $csvExportHelper->makeCsvLine($arrayContent);
                    $response = $this->getResponse();
                    $response->getHeaders()
                             ->addHeaderLine('Content-Type', 'text/csv')
                             ->addHeaderLine('Content-Disposition', 'attachment; filename="stato_civile_'.date("dmYHis").'.csv"')
                             ->addHeaderLine('Accept-Ranges', 'bytes')
                             ->addHeaderLine('Content-Length', strlen($content) );
                    $response->setContent($content);
                    return $response;
                }
            }
        }

        return $this->redirectForUnvalidAccess();
    }

    /**
     * PDF export
     *
     * @return PdfModel|\Zend\Http\Response
     * @throws \ModelModule\Model\NullException
     */
    public function pdfAction()
    {
        if ($this->getRequest()->isPost()) {

            $this->initializeFrontendWebsite();

            $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

            $wrapper = new StatoCivileGetterWrapper(new StatoCivileGetter($em));
            $wrapper->setInput(array(
                'numero'        => isset($post['numero']) ? $post['numero'] : null,
                'anno'          => isset($post['anno']) ? $post['anno'] : null,
                'sezioneId'     => isset($post['sezione']) ? $post['sezione'] : null,
                'noScaduti'     => isset($post['expired']) ? $post['expired'] : null,
                'textSearch'    => isset($post['testo']) ? $post['testo'] : null,
                'orderBy'       => 'sca.id DESC',
                'limit'         => 1500,
            ));
            $wrapper->setupQueryBuilder();

            $records = $wrapper->getRecords();

            $pdf = new PdfModel();
            $pdf->setOption('filename',         'stato-civile-'.date("dmYHis"));
            $pdf->setOption('paperSize',        'a4');
            $pdf->setOption('paperOrientation', 'landscape');
            $pdf->setVariables( array(
                    'records' => $records,
                    'sitename' => $this->layout()->getVariable('sitename'),
                )
            );

            return $pdf;
        }

        return $this->redirectForUnvalidAccess();
    }

    /**
     * TXT action
     *
     * @return \Zend\Http\Response|\Zend\Stdlib\ResponseInterface
     * @throws \ModelModule\Model\NullException
     */
    public function txtAction()
    {
        if ($this->getRequest()->isPost()) {

            $this->initializeFrontendWebsite();

            $request = $this->getRequest();

            $post = array_merge_recursive(
                $request->getPost()->toArray(),
                $request->getFiles()->toArray()
            );

            $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

            $wrapper = new StatoCivileGetterWrapper(new StatoCivileGetter($em));
            $wrapper->setInput(array(
                'numero'        => isset($post['numero']) ? $post['numero'] : null,
                'anno'          => isset($post['anno']) ? $post['anno'] : null,
                'sezioneId'     => isset($post['sezione']) ? $post['sezione'] : null,
                'noScaduti'     => isset($post['expired']) ? $post['expired'] : null,
                'textSearch'    => isset($post['testo']) ? $post['testo'] : null,
                'orderBy'       => 'sca.id DESC',
                'limit'         => 1500,
            ));
            $wrapper->setupQueryBuilder();
            $records = $wrapper->getRecords();

            $content = '';
            $content .= $this->layout()->getVariable('sitename')."\n";
            $content .= "Stato civile \n";
            $content .= "---------------------------------------------------------------- \n";

            foreach($records as $record) {
                $content .= $record['titolo']."\n";
                $content .= 'Sezione: '.$record['nomeSezione']."\n";
                $content .= "Inserito il: ".$record['data']->format("d-m-Y")."\n";
                $content .= "Scadenza: ".$record['scadenza']->format("d-m-Y")."\n";
                $content .= "---------------------------------------------------------------- \n";
            }

            $response = $this->getResponse();
            $response->getHeaders()
                     ->addHeaderLine('Content-Type', 'text/plain')
                     ->addHeaderLine('Content-Disposition', 'attachment; filename="stato_civile_'.date("dmYHis").'.txt"')
                     ->addHeaderLine('Accept-Ranges', 'bytes')
                     ->addHeaderLine('Content-Length', strlen($content) );
            $response->setContent($content);

            return $response;
        }

        return $this->redirectForUnvalidAccess();
    }
}