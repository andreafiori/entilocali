<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsLogs
 *
 * @ORM\Table(name="zfcms_logs")
 * @ORM\Entity
 */
class ZfcmsLogs
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
     * @ORM\Column(name="utente_id", type="bigint", nullable=false)
     */
    private $utenteId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datetime", type="datetime", nullable=false)
     */
    private $datetime;

    /**
     * @var string
     *
     * @ORM\Column(name="azione", type="text", length=65535, nullable=false)
     */
    private $azione;



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
     * Set utenteId
     *
     * @param integer $utenteId
     *
     * @return ZfcmsLogs
     */
    public function setUtenteId($utenteId)
    {
        $this->utenteId = $utenteId;
    
        return $this;
    }

    /**
     * Get utenteId
     *
     * @return integer
     */
    public function getUtenteId()
    {
        return $this->utenteId;
    }

    /**
     * Set datetime
     *
     * @param \DateTime $datetime
     *
     * @return ZfcmsLogs
     */
    public function setDatetime($datetime)
    {
        $this->datetime = $datetime;
    
        return $this;
    }

    /**
     * Get datetime
     *
     * @return \DateTime
     */
    public function getDatetime()
    {
        return $this->datetime;
    }

    /**
     * Set azione
     *
     * @param string $azione
     *
     * @return ZfcmsLogs
     */
    public function setAzione($azione)
    {
        $this->azione = $azione;
    
        return $this;
    }

    /**
     * Get azione
     *
     * @return string
     */
    public function getAzione()
    {
        return $this->azione;
    }
}
