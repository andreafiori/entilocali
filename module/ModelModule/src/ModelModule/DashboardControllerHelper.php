<?php

namespace ModelModule;

use ModelModule\Model\ControllerHelperAbstract;

class DashboardControllerHelper extends ControllerHelperAbstract
{
    /**
     * @param string $lastUpdate
     * @return int
     */
    public function calculateLastUpdatePasswordDays($lastUpdate)
    {
        $lasUpdatePasswordDate1 = new \DateTime(date('Y-m-d', strtotime($lastUpdate)));

        $lasUpdatePasswordDate2 = new \DateTime(date('Y-m-d', strtotime(date("Y-m-d H:i:s"))));

        return $lasUpdatePasswordDate1->diff($lasUpdatePasswordDate2)->days;
    }
}