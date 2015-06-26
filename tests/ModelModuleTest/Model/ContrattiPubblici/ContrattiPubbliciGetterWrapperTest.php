<?php

namespace ModelModuleTest\Model\ContrattiPubblici;

use ModelModule\Model\ContrattiPubblici\Operatori\OperatoriAggiudicatariGetter;
use ModelModule\Model\ContrattiPubblici\Operatori\OperatoriAggiudicatariGetterWrapper;
use ModelModule\Model\ContrattiPubblici\ContrattiPubbliciGetter;
use ModelModule\Model\ContrattiPubblici\ContrattiPubbliciGetterWrapper;
use ModelModuleTest\TestSuite;

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

        $this->objectWrapper->setEntityManager($this->getEntityManagerMock());

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
    }
}
