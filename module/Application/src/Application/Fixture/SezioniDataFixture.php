<?php

namespace Application\Fixture;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ModelModule\Model\Contenuti\ContenutiFormInputFilter;
use ModelModule\Model\Sezioni\SezioniControllerHelper;
use ModelModule\Model\Sezioni\SezioniForm;

class SezioniDataFixture extends FixtureServiceAbstract implements FixtureInterface, OrderedFixtureInterface
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $form = new SezioniForm();
        $form->addOptions();
        $form->addLingue(array(
            'it' => 'Italian',
            'en' => 'English',
        ));
        $form->addIconImage();

        $form->setData(array(
            'titolo'            => 'My Content Title',
            'sommario'          => 'My Content SubTitle',
            'testo'             => 'My Large Text',
            'sottosezione'      => 1,
            'dataInserimento'   => '2015-05-28 01:01:00',
            'dataScadenza'      => '2015-05-28 01:01:00',
            'attivo'            => 1,
            'home'              => 1,
            'rss'               => 1,
            'utente'            => 1,
            'id'                => 1,
        ));

        $inputFilter = new ContenutiFormInputFilter();

        $form->setInputFilter($inputFilter);

        if ($form->isValid()) {
            $inputFilter->exchangeArray($form->getData());

            $helper = new SezioniControllerHelper();
            $helper->setEntityManager($this->recoverEntityManager());
            $helper->setConnection($this->recoverConnection());
            $helper->insert($inputFilter);
        }
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 2;
    }
}