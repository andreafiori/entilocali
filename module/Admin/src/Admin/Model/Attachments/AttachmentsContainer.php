<?php

namespace Admin\Model\Attachments;

/**
 * Static functions for attachment files
 *
 * @author Andrea Fiori
 * @since  08 March 2015
 */
class AttachmentsContainer
{
    /**
     * @param string $filename
     * @param int $id
     *
     * @return mixed|string
     */
    static public function assignFileName($filename, $id)
    {
        $newAttachmentFilename = str_replace(" ", "-", trim(strtolower($filename)) );
        $newAttachmentFilename = preg_replace("/[^a-zA-Z0-9.]/", "", $newAttachmentFilename);
        $newAttachmentFilename = $id.'_'.$newAttachmentFilename;

        return $newAttachmentFilename;
    }
}