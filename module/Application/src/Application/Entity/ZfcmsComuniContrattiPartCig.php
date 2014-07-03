<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsComuniContrattiPartCig
 *
 * @ORM\Table(name="zfcms_comuni_contratti_part_cig")
 * @ORM\Entity
 */
class ZfcmsComuniContrattiPartCig
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_cont_pub_part", type="integer", nullable=false)
     */
    private $idContPubPart;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_cont_pub_data", type="integer", nullable=false)
     */
    private $idContPubData;

    /**
     * @var integer
     *
     * @ORM\Column(name="stato", type="integer", nullable=false)
     */
    private $stato = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="gruppo", type="integer", nullable=false)
     */
    private $gruppo = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="aggiudicatario", type="integer", nullable=false)
     */
    private $aggiudicatario = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="membro", type="integer", nullable=false)
     */
    private $membro = '0';



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idContPubPart
     *
     * @param integer $idContPubPart
     *
     * @return ZfcmsComuniContrattiPartCig
     */
    public function setIdContPubPart($idContPubPart)
    {
        $this->idContPubPart = $idContPubPart;
    
        return $this;
    }

    /**
     * Get idContPubPart
     *
     * @return integer
     */
    public function getIdContPubPart()
    {
        return $this->idContPubPart;
    }

    /**
     * Set idContPubData
     *
     * @param integer $idContPubData
     *
     * @return ZfcmsComuniContrattiPartCig
     */
    public function setIdContPubData($idContPubData)
    {
        $this->idContPubData = $idContPubData;
    
        return $this;
    }

    /**
     * Get idContPubData
     *
     * @return integer
     */
    public function getIdContPubData()
    {
        return $this->idContPubData;
    }

    /**
     * Set stato
     *
     * @param integer $stato
     *
     * @return ZfcmsComuniContrattiPartCig
     */
    public function setStato($stato)
    {
        $this->stato = $stato;
    
        return $this;
    }

    /**
     * Get stato
     *
     * @return integer
     */
    public function getStato()
    {
        return $this->stato;
    }

    /**
     * Set gruppo
     *
     * @param integer $gruppo
     *
     * @return ZfcmsComuniContrattiPartCig
     */
    public function setGruppo($gruppo)
    {
        $this->gruppo = $gruppo;
    
        return $this;
    }

    /**
     * Get gruppo
     *
     * @return integer
     */
    public function getGruppo()
    {
        return $this->gruppo;
    }

    /**
     * Set aggiudicatario
     *
     * @param integer $aggiudicatario
     *
     * @return ZfcmsComuniContrattiPartCig
     */
    public function setAggiudicatario($aggiudicatario)
    {
        $this->aggiudicatario = $aggiudicatario;
    
        return $this;
    }

    /**
     * Get aggiudicatario
     *
     * @return integer
     */
    public function getAggiudicatario()
    {
        return $this->aggiudicatario;
    }

    /**
     * Set membro
     *
     * @param integer $membro
     *
     * @return ZfcmsComuniContrattiPartCig
     */
    public function setMembro($membro)
    {
        $this->membro = $membro;
    
        return $this;
    }

    /**
     * Get membro
     *
     * @return integer
     */
    public function getMembro()
    {
        return $this->membro;
    }
}
