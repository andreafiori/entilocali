<?php

namespace AdminTest\Model\ContrattiPubblici;

use Admin\Model\ContrattiPubblici\Operatori\OperatoriAggiudicatariGetter;
use Admin\Model\ContrattiPubblici\Operatori\OperatoriAggiudicatariGetterWrapper;
use ApplicationTest\TestSuite;
use Admin\Model\ContrattiPubblici\ContrattiPubbliciGetter;
use Admin\Model\ContrattiPubblici\ContrattiPubbliciGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  18 August 2014
 */
class ContrattiPubbliciGetterWrapperTest extends TestSuite
{
    /**
     * @var ContrattiPubbliciGetterWrapper
     */
    private $objectWrapper;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->objectWrapper = new ContrattiPubbliciGetterWrapper(
            new ContrattiPubbliciGetter($this->getEntityManagerMock())
        );
    }
    
    public function testSetupQueryBuilder()
    {
        $this->assertNull( $this->objectWrapper->setupQueryBuilder() );
    }

    public function testAddListaPartecipanti()
    {
        $this->objectWrapper->setOperatoriAggiudicatariGetterWrapper(
            new OperatoriAggiudicatariGetterWrapper(new OperatoriAggiudicatariGetter($this->getEntityManagerMock()))
        );

        $records = $this->objectWrapper->addListaPartecipanti(array(
            array(
                'id'            => 1,
                'beneficiario'  => 'Beneficiario 1',
            ),
            array(
                'id'            => 2,
                'beneficiario'  => 'Beneficiario 2',
            ),
        ));

        $this->assertArrayHasKey('operatori', $records[0]);
        $this->assertArrayHasKey('aggiudicatario', $records[0]);
    }
}
