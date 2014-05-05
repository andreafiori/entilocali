<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Posts
 *
 * @ORM\Table(name="posts", indexes={@ORM\Index(name="parent_id", columns={"parent_id"}), @ORM\Index(name="stato", columns={"stato"}), @ORM\Index(name="alias", columns={"alias"}), @ORM\Index(name="flag_allegati", columns={"flag_allegati"})})
 * @ORM\Entity
 */
class Posts
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
     * @var string
     *
     * @ORM\Column(name="note", type="string", length=80, nullable=true)
     */
    private $note;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_inserimento", type="datetime", nullable=false)
     */
    private $dataInserimento = '2013-01-01 00:00:00';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_scadenza", type="datetime", nullable=false)
     */
    private $dataScadenza = '2030-02-10 00:00:00';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_ultimo_aggiornamento", type="datetime", nullable=false)
     */
    private $dataUltimoAggiornamento = '2030-02-10 00:00:00';

    /**
     * @var integer
     *
     * @ORM\Column(name="parent_id", type="bigint", nullable=false)
     */
    private $parentId = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="stato", type="string", length=80, nullable=true)
     */
    private $stato;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=40, nullable=false)
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="template_file", type="string", length=50, nullable=false)
     */
    private $templateFile;

    /**
     * @var string
     *
     * @ORM\Column(name="alias", type="string", length=40, nullable=false)
     */
    private $alias;

    /**
     * @var string
     *
     * @ORM\Column(name="flag_allegati", type="string", nullable=false)
     */
    private $flagAllegati;



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
     * Set note
     *
     * @param string $note
     *
     * @return Posts
     */
    public function setNote($note)
    {
        $this->note = $note;
    
        return $this;
    }

    /**
     * Get note
     *
     * @return string 
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set dataInserimento
     *
     * @param \DateTime $dataInserimento
     *
     * @return Posts
     */
    public function setDataInserimento($dataInserimento)
    {
        $this->dataInserimento = $dataInserimento;
    
        return $this;
    }

    /**
     * Get dataInserimento
     *
     * @return \DateTime 
     */
    public function getDataInserimento()
    {
        return $this->dataInserimento;
    }

    /**
     * Set dataScadenza
     *
     * @param \DateTime $dataScadenza
     *
     * @return Posts
     */
    public function setDataScadenza($dataScadenza)
    {
        $this->dataScadenza = $dataScadenza;
    
        return $this;
    }

    /**
     * Get dataScadenza
     *
     * @return \DateTime 
     */
    public function getDataScadenza()
    {
        return $this->dataScadenza;
    }

    /**
     * Set dataUltimoAggiornamento
     *
     * @param \DateTime $dataUltimoAggiornamento
     *
     * @return Posts
     */
    public function setDataUltimoAggiornamento($dataUltimoAggiornamento)
    {
        $this->dataUltimoAggiornamento = $dataUltimoAggiornamento;
    
        return $this;
    }

    /**
     * Get dataUltimoAggiornamento
     *
     * @return \DateTime 
     */
    public function getDataUltimoAggiornamento()
    {
        return $this->dataUltimoAggiornamento;
    }

    /**
     * Set parentId
     *
     * @param integer $parentId
     *
     * @return Posts
     */
    public function setParentId($parentId)
    {
        $this->parentId = $parentId;
    
        return $this;
    }

    /**
     * Get parentId
     *
     * @return integer 
     */
    public function getParentId()
    {
        return $this->parentId;
    }

    /**
     * Set stato
     *
     * @param string $stato
     *
     * @return Posts
     */
    public function setStato($stato)
    {
        $this->stato = $stato;
    
        return $this;
    }

    /**
     * Get stato
     *
     * @return string 
     */
    public function getStato()
    {
        return $this->stato;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     *
     * @return Posts
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    
        return $this;
    }

    /**
     * Get tipo
     *
     * @return string 
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set templateFile
     *
     * @param string $templateFile
     *
     * @return Posts
     */
    public function setTemplateFile($templateFile)
    {
        $this->templateFile = $templateFile;
    
        return $this;
    }

    /**
     * Get templateFile
     *
     * @return string 
     */
    public function getTemplateFile()
    {
        return $this->templateFile;
    }

    /**
     * Set alias
     *
     * @param string $alias
     *
     * @return Posts
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;
    
        return $this;
    }

    /**
     * Get alias
     *
     * @return string 
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * Set flagAllegati
     *
     * @param string $flagAllegati
     *
     * @return Posts
     */
    public function setFlagAllegati($flagAllegati)
    {
        $this->flagAllegati = $flagAllegati;
    
        return $this;
    }

    /**
     * Get flagAllegati
     *
     * @return string 
     */
    public function getFlagAllegati()
    {
        return $this->flagAllegati;
    }
}
