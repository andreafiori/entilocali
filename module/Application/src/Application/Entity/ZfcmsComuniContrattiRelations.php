<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsComuniContrattiRelations
 *
 * @ORM\Table(name="zfcms_comuni_contratti_relations", indexes={@ORM\Index(name="cont_pub_data_id", columns={"contratto_id"}), @ORM\Index(name="cont_pub_part_id", columns={"partecipante_id"})})
 * @ORM\Entity
 */
class ZfcmsComuniContrattiRelations
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
     * @ORM\Column(name="membro", type="bigint", nullable=false)
     */
    private $membro = '0';

    /**
     * @var \Application\Entity\ZfcmsComuniContratti
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ZfcmsComuniContratti")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="contratto_id", referencedColumnName="id")
     * })
     */
    private $contratto;

    /**
     * @var \Application\Entity\ZfcmsComuniContrattiPartecipanti
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ZfcmsComuniContrattiPartecipanti")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="partecipante_id", referencedColumnName="id")
     * })
     */
    private $partecipante;



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
     * @return ZfcmsComuniContrattiRelations
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
     * @return ZfcmsComuniContrattiRelations
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
     * @return ZfcmsComuniContrattiRelations
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
     * @return ZfcmsComuniContrattiRelations
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
     * Set contratto
     *
     * @param \Application\Entity\ZfcmsComuniContratti $contratto
     * @return ZfcmsComuniContrattiRelations
     */
    public function setContratto(\Application\Entity\ZfcmsComuniContratti $contratto = null)
    {
        $this->contratto = $contratto;
    
        return $this;
    }

    /**
     * Get contratto
     *
     * @return \Application\Entity\ZfcmsComuniContratti 
     */
    public function getContratto()
    {
        return $this->contratto;
    }

    /**
     * Set partecipante
     *
     * @param \Application\Entity\ZfcmsComuniContrattiPartecipanti $partecipante
     * @return ZfcmsComuniContrattiRelations
     */
    public function setPartecipante(\Application\Entity\ZfcmsComuniContrattiPartecipanti $partecipante = null)
    {
        $this->partecipante = $partecipante;
    
        return $this;
    }

    /**
     * Get partecipante
     *
     * @return \Application\Entity\ZfcmsComuniContrattiPartecipanti 
     */
    public function getPartecipante()
    {
        return $this->partecipante;
    }
}
