<?php

namespace ModelModule\Model\AttiConcessione\ModalitaAssegnazione;

use ModelModule\Model\RecordsGetterWrapperAbstract;

/**
 * @author Andrea Fiori
 * @since  30 March 2015
 */
class AttiConcessioneModalitaAssegnazioneGetterWrapper  extends RecordsGetterWrapperAbstract
{
    /**
     * @var AttiConcessioneModalitaAssegnazioneGetter
     */
    protected $objectGetter;

    /**
     * @param AttiConcessioneModalitaAssegnazioneGetter $objectGetter
     */
    public function __construct(AttiConcessioneModalitaAssegnazioneGetter $objectGetter)
    {
        $this->setObjectGetter($objectGetter);
    }

    /**
     * @return null
     */
    public function setupQueryBuilder()
    {
        $this->objectGetter->setSelectQueryFields( $this->getInput('fields', 1) );

        $this->objectGetter->setMainQuery();

        $this->objectGetter->setId( $this->getInput('id', 1) );
        $this->objectGetter->setOrderBy( $this->getInput('orderBy', 1) );
        $this->objectGetter->setGroupBy( $this->getInput('groupBy', 1) );
        $this->objectGetter->setLimit( $this->getInput('limit', 1) );

        return null;
    }
}