<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsComuniContrattiPartCig
 *
 * @ORM\Table(name="zfcms_comuni_contratti_part_cig", indexes={@ORM\Index(name="cont_pub_data_id", columns={"cont_pub_id"}), @ORM\Index(name="cont_pub_part_id", columns={"cont_pub_part_id"}), @ORM\Index(name="aggiudicatario", columns={"aggiudicatario"})})
 * @ORM\Entity
 */
class ZfcmsComuniContrattiPartCig
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="stato", type="integer", nullable=false)
     */
    private $stato;

    /**
     * @var integer
     *
     * @ORM\Column(name="gruppo", type="integer", nullable=false)
     */
    private $gruppo;

    /**
     * @var integer
     *
     * @ORM\Column(name="aggiudicatario", type="bigint", nullable=false)
     */
    private $aggiudicatario;

    /**
     * @var integer
     *
     * @ORM\Column(name="membro", type="bigint", nullable=false)
     */
    private $membro;

    /**
     * @var integer
     *
     * @ORM\Column(name="cont_pub_part_id", type="bigint", nullable=false)
     */
    private $contPubPartId;

    /**
     * @var integer
     *
     * @ORM\Column(name="cont_pub_id", type="bigint", nullable=false)
     */
    private $contPubId;



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

    /**
     * Set contPubPartId
     *
     * @param integer $contPubPartId
     *
     * @return ZfcmsComuniContrattiPartCig
     */
    public function setContPubPartId($contPubPartId)
    {
        $this->contPubPartId = $contPubPartId;
    
        return $this;
    }

    /**
     * Get contPubPartId
     *
     * @return integer
     */
    public function getContPubPartId()
    {
        return $this->contPubPartId;
    }

    /**
     * Set contPubId
     *
     * @param integer $contPubId
     *
     * @return ZfcmsComuniContrattiPartCig
     */
    public function setContPubId($contPubId)
    {
        $this->contPubId = $contPubId;
    
        return $this;
    }

    /**
     * Get contPubId
     *
     * @return integer
     */
    public function getContPubId()
    {
        return $this->contPubId;
    }
}
