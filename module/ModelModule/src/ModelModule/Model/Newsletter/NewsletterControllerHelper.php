<?php

namespace ModelModule\Model\Newsletter;

use ModelModule\Model\ControllerHelperAbstract;
use ModelModule\Model\Database\DbTableContainer;
use Zend\InputFilter\InputFilterAwareInterface;

class NewsletterControllerHelper extends ControllerHelperAbstract
{
    /**
     * Insert newsltter into database
     *
     * @param InputFilterAwareInterface $formData
     *
     * @return string
     */
    public function insert(InputFilterAwareInterface $formData)
    {
        $this->assertConnection();

        $this->getConnection()->insert(
            DbTableContainer::newsletter,
            array(
                'title'         => $formData->title,
                'message_text'  => $formData->messageText,
                'create_date'   => date("Y-m-d H:i:s"),
                'format'        => 'html',
                'sent'          => 0,
            )
        );

        return $this->getConnection()->lastInsertId();
    }

    /**
     * Update newsletter
     *
     * @param InputFilterAwareInterface $formData
     *
     * @return int
     */
    public function update(InputFilterAwareInterface $formData)
    {
        $this->assertConnection();

        return $this->getConnection()->update(
            DbTableContainer::newsletter,
            array(
                'title'         => $formData->title,
                'message_text'  => $formData->messageText,
                'create_date'   => date("Y-m-d H:i:s"),
                'format'        => 'html',
                'sent'          => 0,
            ),
            array('id' => $formData->id),
            array('limit' => 1)
        );
    }
}