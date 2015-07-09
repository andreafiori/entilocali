<?php

namespace ModelModule\Model\Attachments;

use ModelModule\Model\RecordsGetterWrapperAbstract;

/**
 * Refactoring of select attachments form data for each module
 */
abstract class AttachmentsFormSelectionAbstract
{
    abstract public function recoverAttachments(RecordsGetterWrapperAbstract $wrapper);
}