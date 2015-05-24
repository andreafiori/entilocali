<?php

namespace Application\Model\HomePage;

class FreeTextHomePageBuilder extends HomePageBuilderAbstract
{
    public function recoverHomePageElements()
    {
        $value = $this->getModuleRelatedRecords();

        $freeTexts = array();
        foreach($value as $record) {
            if (!empty($record['freeText'])) {
                $freeTexts[] = array('freeText' => $record['freeText']);
            }
        }

        return $freeTexts;
    }
}