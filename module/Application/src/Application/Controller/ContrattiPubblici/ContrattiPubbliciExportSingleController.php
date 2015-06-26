<?php

namespace Application\Controller\ContrattiPubblici;

use Application\Controller\SetupAbstractController;
use ModelModule\Model\ContrattiPubblici\ContrattiPubbliciControllerHelper;
use ModelModule\Model\ContrattiPubblici\ContrattiPubbliciGetter;
use ModelModule\Model\ContrattiPubblici\ContrattiPubbliciGetterWrapper;
use Zend\View\Model\JsonModel;

class ContrattiPubbliciExportSingleController extends SetupAbstractController
{
    public function pdfAction()
    {

    }

    public function csvAction()
    {

    }


    public function txtAction()
    {
        $this->initializeFrontendWebsite();

        $id = $this->params()->fromRoute('id');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $helper = new ContrattiPubbliciControllerHelper();
        $wrapper = $helper->recoverWrapperById(
            new ContrattiPubbliciGetterWrapper(new ContrattiPubbliciGetter($em)),
            array('id' => $id, 'limit' => 1),
            $id
        );
        $wrapper->setEntityManager($em);
        $records = $wrapper->addAttachmentsFromRecords($wrapper->getRecords(), array());

        if (empty($records)) {
            return $this->redirectForUnvalidAccess();
        }

        $content = '';
        $content .= $this->layout()->getVariable('sitename').', Bandi di gara e contratti'.PHP_EOL;
        $content .= PHP_EOL;

        foreach($records as $record) {
            $content .= 'Bando:'.PHP_EOL;
            $content .= $record['titolo'].PHP_EOL;
            $content .= 'CIG: '.$record['cig'].PHP_EOL;
            $content .= 'Anno: '.$record['anno'].PHP_EOL;
            $content .= '--------------------------------------------------------------------------'.PHP_EOL;

            $content .= "\t\t".'Struttura proponente'.PHP_EOL.PHP_EOL;
            $content .= 'CF: '.PHP_EOL; // TODO: cf from configurations
            $content .= 'Struttura proponente: '.$record['nomeSettore'].PHP_EOL;
            $content .= 'Responsabile: '.$record['responsabileUsersName'].' '.$record['responsabileUsersSurname'].PHP_EOL;
            $content .= 'Resp. Proc: '.$record['responsabileUsersName'].' '.$record['responsabileUsersSurname'].PHP_EOL;
            $content .= '--------------------------------------------------------------------------'.PHP_EOL;
            $content .= "\t\t".'Procedura di scelta del contraente '.PHP_EOL.PHP_EOL;
            $content .= $record['nomeScelta'].PHP_EOL;
            $content .= '--------------------------------------------------------------------------'.PHP_EOL;
            $content .= "\t\t".'Operatori invitati a presentare le offerte'.PHP_EOL.PHP_EOL;
            if (!empty($record['operatori'])):
                foreach($record['operatori'] as $operatore):
                // CF-PI:</strong> <?php echo $operatore['cf']
                // Nome e Ragione sociale: $operatore['nome'].' '.$operatore['ragioneSociale']
                endforeach;
            else:
                $content .= 'Nessun operatore'.PHP_EOL;
            endif;
            $content .= '--------------------------------------------------------------------------'.PHP_EOL;
            $content .= "\t\t".'Aggiudicatario'.PHP_EOL.PHP_EOL;
            if (!empty($row['operatori-aggiudicatari'])):
                foreach($row['operatori-aggiudicatari'] as $operatore):
                    $content .= 'CF-PI:'.$operatore['cf'].PHP_EOL;
                    $content .= 'Nome e ragione sociale:'.$operatore['nome'].' '.$operatore['ragioneSociale'].PHP_EOL;
                endforeach;
            else:
                $content .= 'Nessun aggiudicatario'.PHP_EOL;
            endif;
            $content .= '--------------------------------------------------------------------------'.PHP_EOL;
            $content .= "\t\t".'Importi'.PHP_EOL.PHP_EOL;
            $content .= 'Importo di aggiudicazione: '.floatval($record['importoAggiudicazione']).' euro'.PHP_EOL;
            $content .= 'Importo liquidato: '.floatval($record['importoLiquidato']).' euro'.PHP_EOL;
            $content .= '---------------------------------------------------------------------------'.PHP_EOL;
            $content .= "\t\t".'Tempi di completamento'.PHP_EOL.PHP_EOL;
            $content .= 'Inizio lavori: '.$record['dataInizioLavori']->format("m d Y").PHP_EOL;
            $content .= 'Fine lavori: '.$record['dataFineLavori']->format("m d Y").PHP_EOL;

            if (!empty($row['attachments'])):
                //Allegati
                foreach($row['attachments'] as $attachment):
                    // $this->url('attachments-sthree-download', array('type' => 'contratti-pubblici', 'id' => $attachment['id']));    echo $attachment['title']  $attachment['size'] Kb
                        // $attachment['size'] Kb
                    //echo $attachment['title']
                endforeach;
            endif;
        }
        $content .= " ".PHP_EOL.PHP_EOL;
        $content .= date("Y").' '.$this->layout()->getVariable('sitename');

        $response = $this->getResponse();
        $response->getHeaders()
            ->addHeaderLine('Content-Type', 'text/plain')
            //->addHeaderLine('Content-Disposition', 'attachment; filename="'.Slugifier::slugify($record['titolo']).'.txt"')
            ->addHeaderLine('Accept-Ranges', 'bytes')
            ->addHeaderLine('Content-Length', strlen($content) );

        $response->setContent($content);

        return $response;
    }

    public function jsonAction()
    {
        $this->initializeFrontendWebsite();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = $this->params()->fromRoute('id');

        $helper = new ContrattiPubbliciControllerHelper();
        $wrapper = $helper->recoverWrapperById(
            new ContrattiPubbliciGetterWrapper(new ContrattiPubbliciGetter($em)),
            array('id' => $id, 'limit' => 1),
            $id
        );
        $wrapper->setEntityManager($em);

        $records = $wrapper->addAttachmentsFromRecords($wrapper->getRecords(), array());

        if (empty($records)) {
            return $this->redirectForUnvalidAccess();
        }
        $record = $records[0];

        return new JsonModel(array(
            "Oggetto" => $record['titolo'],
        ));
    }
}