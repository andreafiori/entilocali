<?php

namespace ModelModuleTest\Model\Contenuti;

use ModelModuleTest\TestSuite;
use ModelModule\Model\Contenuti\ContenutiGetter;

class ContenutiGetterTest extends TestSuite
{
    /**
     * @var ContenutiGetter
     */
    private $objectGetter;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->objectGetter = new ContenutiGetter( $this->getEntityManagerMock() );
    }
    
    public function testSetMainQuery()
    {
        $this->objectGetter->setMainQuery();
        
        $this->assertTrue( is_array($this->objectGetter->getQueryResult()) );
    }
    
    public function testSetId()
    {
        $this->objectGetter->setId(1);
        
        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('id'));        
    }
    
    public function testSetIdWithArrayInInput()
    {
        $this->objectGetter->setId(array(1,2,3));
        
        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('id'));
    }

    public function testSetExcludeSezioneId()
    {
        $this->objectGetter->setExcludeSezioneId(11);

        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('excludeSottoSezioneId'));
    }

    public function testSetSezioneId()
    {
        $this->objectGetter->setSezioneId(1);

        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('sezioneId'));
    }

    public function testSetExcludeSottoSezioneId()
    {
        $this->objectGetter->setExcludeSottoSezioneId(1);

        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('excludeSottoSezioneId'));
    }

    public function testSetExcludeSottoSezioneIdWithArrayParameter()
    {
        $this->objectGetter->setExcludeSottoSezioneId(array(1,2,3));

        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('excludeSottoSezioneId'));
    }

    public function testSetExcludeSezioneIdWithArrayInput()
    {
        $this->objectGetter->setExcludeSezioneId(array(1,2,3));

        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('excludeSottoSezioneId'));
    }
    
    public function testSetSottosezione()
    {
        $this->objectGetter->setSottosezione(1);
        
        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('sottosezione'));        
    }
    
    public function testSetSottosezioneWithArrayInInput()
    {
        $this->objectGetter->setSottosezione( array(1,2,3) );

        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('sottosezione'));
    }
    
    public function testSetNumero()
    {
        $this->objectGetter->setNumero(132);
        
        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('numero'));        
    }
    
    public function testSetAnno()
    {
        $this->objectGetter->setAnno(2015);
        
        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('anno'));        
    }
    
    public function testSetDataScadenza()
    {
        $this->objectGetter->setDataScadenza(2015);

        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('scadenza'));
    }

    public function testSetNoScaduti()
    {
        $this->assertInstanceOf('\Doctrine\ORM\QueryBuilder', $this->objectGetter->setNoScaduti(1));
    }

    public function testSetModulo()
    {
        $this->objectGetter->setModulo(11);

        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('moduloId'));
    }

    public function testAttivo()
    {
        $this->objectGetter->setAttivo(1);

        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('attivo'));
    }

    public function testSetUtente()
    {
        $this->objectGetter->setUtente('43');

        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('utenteId'));
    }

    public function testSetShowToAll()
    {
        $this->objectGetter->setShowToAll('1');

        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('showToAll'));
    }

    public function testSetLingua()
    {
        $this->objectGetter->setLingua('it');

        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('lingua'));
    }

    public function testSetInhome()
    {
        $this->objectGetter->setInHome(1);

        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('inhome'));
    }

    public function testSetFreeSearch()
    {
        $this->objectGetter->setFreeSearch('my free search text test');

        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('freeSearch'));
    }
}