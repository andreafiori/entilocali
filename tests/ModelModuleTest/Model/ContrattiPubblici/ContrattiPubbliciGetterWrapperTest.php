<?php

namespace ModelModuleTest\Model\ContrattiPubblici;

use ModelModule\Model\ContrattiPubblici\Operatori\OperatoriAggiudicatariGetter;
use ModelModule\Model\ContrattiPubblici\Operatori\OperatoriAggiudicatariGetterWrapper;
use ModelModuleTest\TestSuite;
use ModelModule\Model\ContrattiPubblici\ContrattiPubbliciGetter;
use ModelModule\Model\ContrattiPubblici\ContrattiPubbliciGetterWrapper;

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
