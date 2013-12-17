<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProdottiOfferte
 *
 * @ORM\Table(name="prodotti_offerte")
 * @ORM\Entity
 */
class ProdottiOfferte
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idoff", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idoff;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dataofferta", type="datetime", nullable=false)
     */
    private $dataofferta = '2008-01-01 01:01:01';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datascadenza", type="datetime", nullable=false)
     */
    private $datascadenza = '2008-01-01 01:01:01';

    /**
     * @var string
     *
     * @ORM\Column(name="scadenzattiva", type="string", nullable=false)
     */
    private $scadenzattiva = 'no';

    /**
     * @var string
     *
     * @ORM\Column(name="visible", type="string", nullable=false)
     */
    private $visible = 'si';

    /**
     * @var integer
     *
     * @ORM\Column(name="rifazienda", type="integer", nullable=false)
     */
    private $rifazienda = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="prezzofferta", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $prezzofferta = '0.00';

    /**
     * @var integer
     *
     * @ORM\Column(name="qt", type="integer", nullable=false)
     */
    private $qt = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="rifidprod", type="integer", nullable=false)
     */
    private $rifidprod = '0';



    /**
     * Get idoff
     *
     * @return integer 
     */
    public function getIdoff()
    {
        return $this->idoff;
    }

    /**
     * Set dataofferta
     *
     * @param \DateTime $dataofferta
     * @return ProdottiOfferte
     */
    public function setDataofferta($dataofferta)
    {
        $this->dataofferta = $dataofferta;

        return $this;
    }

    /**
     * Get dataofferta
     *
     * @return \DateTime 
     */
    public function getDataofferta()
    {
        return $this->dataofferta;
    }

    /**
     * Set datascadenza
     *
     * @param \DateTime $datascadenza
     * @return ProdottiOfferte
     */
    public function setDatascadenza($datascadenza)
    {
        $this->datascadenza = $datascadenza;

        return $this;
    }

    /**
     * Get datascadenza
     *
     * @return \DateTime 
     */
    public function getDatascadenza()
    {
        return $this->datascadenza;
    }

    /**
     * Set scadenzattiva
     *
     * @param string $scadenzattiva
     * @return ProdottiOfferte
     */
    public function setScadenzattiva($scadenzattiva)
    {
        $this->scadenzattiva = $scadenzattiva;

        return $this;
    }

    /**
     * Get scadenzattiva
     *
     * @return string 
     */
    public function getScadenzattiva()
    {
        return $this->scadenzattiva;
    }

    /**
     * Set visible
     *
     * @param string $visible
     * @return ProdottiOfferte
     */
    public function setVisible($visible)
    {
        $this->visible = $visible;

        return $this;
    }

    /**
     * Get visible
     *
     * @return string 
     */
    public function getVisible()
    {
        return $this->visible;
    }

    /**
     * Set rifazienda
     *
     * @param integer $rifazienda
     * @return ProdottiOfferte
     */
    public function setRifazienda($rifazienda)
    {
        $this->rifazienda = $rifazienda;

        return $this;
    }

    /**
     * Get rifazienda
     *
     * @return integer 
     */
    public function getRifazienda()
    {
        return $this->rifazienda;
    }

    /**
     * Set prezzofferta
     *
     * @param string $prezzofferta
     * @return ProdottiOfferte
     */
    public function setPrezzofferta($prezzofferta)
    {
        $this->prezzofferta = $prezzofferta;

        return $this;
    }

    /**
     * Get prezzofferta
     *
     * @return string 
     */
    public function getPrezzofferta()
    {
        return $this->prezzofferta;
    }

    /**
     * Set qt
     *
     * @param integer $qt
     * @return ProdottiOfferte
     */
    public function setQt($qt)
    {
        $this->qt = $qt;

        return $this;
    }

    /**
     * Get qt
     *
     * @return integer 
     */
    public function getQt()
    {
        return $this->qt;
    }

    /**
     * Set rifidprod
     *
     * @param integer $rifidprod
     * @return ProdottiOfferte
     */
    public function setRifidprod($rifidprod)
    {
        $this->rifidprod = $rifidprod;

        return $this;
    }

    /**
     * Get rifidprod
     *
     * @return integer 
     */
    public function getRifidprod()
    {
        return $this->rifidprod;
    }
}
