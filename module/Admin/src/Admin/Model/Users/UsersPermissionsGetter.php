<?php

namespace Admin\Model\Users;

use Application\Model\QueryBuilderHelperAbstract;

/**
 * @author Andrea Fiori
 * @since  17 November 2014
 */
class UsersPermissionsGetter extends QueryBuilderHelperAbstract
{
    public function setMainQuery()
    {
        $this->setSelectQueryFields('DISTINCT(up.id) AS id ');

        $this->getQueryBuilder()->add('select', $this->getSelectQueryFields())
                                ->add('from', 'Application\Entity\ZfcmsUsersPermissions up')
                                ->join('ur.role', 'ur')
                                ->join('ur.permission', 'upn')
                                ->where("(up.role = ur.id AND ) ");

        return $this->getQueryBuilder();
    }
}
