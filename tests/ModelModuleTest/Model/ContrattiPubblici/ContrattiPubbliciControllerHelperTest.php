<?php

namespace ModelModuleTest\Model\ContrattiPubblici;

use ModelModule\Model\ContrattiPubblici\ContrattiPubbliciControllerHelper;
use ModelModule\Model\ContrattiPubblici\ContrattiPubbliciFormInputFilter;
use ModelModuleTest\TestSuite;

class ContrattiPubbliciControllerHelperTest extends TestSuite
{
    /**
     * @var ContrattiPubbliciControllerHelper
     */
    private $helper;

    protected function setUp()
    {
        parent::setUp();

        $this->helper = new ContrattiPubbliciControllerHelper();
    }

    public function testInsert()
    {
        $this->helper->setConnection($this->getConnectionMock());

        $this->helper->setLoggedUser($this->recoverUserDetails());

        $this->assertEquals(
            $this->helper->insert(new ContrattiPubbliciFormInputFilter()),
            true
        );
    }

    public function testUpdate()
    {
        $this->helper->setConnection($this->getConnectionMock());

        $this->helper->setLoggedUser($this->recoverUserDetails());

        $this->assertEquals(
            $this->helper->update(new ContrattiPubbliciFormInputFilter()),
            true
        );
    }

    public function testDelete()
    {
        $this->helper->setConnection($this->getConnectionMock());

        $this->helper->setLoggedUser($this->recoverUserDetails());

        $this->assertEquals(
            $this->helper->delete(1),
            true
        );
    }

    public function testDeleteContrattiRelationsByContractId()
    {
        $this->helper->setConnection($this->getConnectionMock());

        $this->helper->setLoggedUser($this->recoverUserDetails());

        $this->assertEquals(
            $this->helper->deleteContrattiRelationsByContractId(1),
            true
        );
    }

    public function testUpdateAttivo()
    {
        $this->helper->setConnection($this->getConnectionMock());

        $this->helper->setLoggedUser($this->recoverUserDetails());

        $this->assertEquals(
            $this->helper->updateAttivo(1),
            true
        );
    }

    public function testUpdateHome()
    {
        $this->helper->setConnection($this->getConnectionMock());

        $this->helper->setLoggedUser($this->recoverUserDetails());

        $this->assertEquals(
            $this->helper->updateHome(1),
            true
        );
    }

    public function testFormatUsersRespProcRecords()
    {
        $this->helper->setConnection($this->getConnectionMock());

        $this->helper->setLoggedUser($this->recoverUserDetails());

        $formattedUsers = $this->helper->formatUsersRespProcRecords(array(
            array('id' => 1, 'name' => 'Andrea'),
            array('id' => 1, 'name' => 'John'),
        ));
    }
}