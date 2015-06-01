<?php

namespace ModelModule\Model\Sezioni;

use ModelModule\Model\Modules\ModulesContainer;
use ModelModule\Model\Database\DbTableContainer;
use ModelModule\Model\Slugifier;
use Zend\InputFilter\InputFilterAwareInterface;
use ModelModule\Model\NullException;

class SezioniControllerHelper extends SezioniControllerHelperAbstract
{
    public function insert(InputFilterAwareInterface $inputFilter)
    {
        $this->assertConnection();

        $this->assertLoggedUser();

        $userDetails = $this->getLoggedUser();

        return $this->getConnection()->insert(DbTableContainer::sezioni, array(
            'nome'             => $inputFilter->nome,
            'colonna'          => $inputFilter->colonna,
            'posizione'        => $inputFilter->posizione,
            'lingua'           => $inputFilter->lingua,
            'blocco'           => $inputFilter->blocco,
            'modulo_id'        => isset($inputFilter->modulo) ? $inputFilter->modulo : ModulesContainer::contenuti_id,
            'attivo'           => $inputFilter->attivo,
            'url'              => $inputFilter->url,
            'slug'             => Slugifier::slugify($inputFilter->nome),
            'utente_id'        => $userDetails->id,
            /*
            'link_macro'       => $inputFilter->link_macro,
            'css_id'           => $inputFilter->css_id,
            'image'            => $inputFilter->image,
            'seo_title'        => $inputFilter->seoTitle,
            'seo_description'  => $inputFilter->seoDescription,
            'seo_keywords'     => $inputFilter->seoKeywords,
            'show_to_all'      => $inputFilter->show_to_all,
            */
            'is_amm_trasparente' => $inputFilter->isAmmTrasparente,
        ));
    }
    
    /**
     * @param InputFilterAwareInterface $inputFilter
     * @return int
     * @throws NullException
     */
    public function update(InputFilterAwareInterface $inputFilter)
    {
        $this->assertConnection();

        return $this->getConnection()->update(
            DbTableContainer::sezioni,
            array(
                'nome'        => $inputFilter->nome,
                'colonna'     => $inputFilter->colonna,
                'lingua'      => $inputFilter->lingua,
                'attivo'      => $inputFilter->attivo,
                'url'         => $inputFilter->url,
                'slug'        => Slugifier::slugify($inputFilter->nome),
            ),
            array(
                'id' => $inputFilter->id
            )
        );
    }
}