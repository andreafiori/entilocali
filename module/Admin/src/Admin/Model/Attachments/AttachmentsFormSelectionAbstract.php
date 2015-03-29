<?php

namespace Admin\Model\Attachments;

use Application\Model\RecordsGetterWrapperAbstract;

/**
 * Refactoring of select attachments form data for each module
 */
abstract class AttachmentsFormSelectionAbstract
{
    abstract public function recoverAttachments(RecordsGetterWrapperAbstract $wrapper);
}