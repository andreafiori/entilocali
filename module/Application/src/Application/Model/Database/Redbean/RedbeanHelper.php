<?php

namespace Application\Model\Database\Redbean;

use Application\Model\Database\Redbean\R;

/**
 * @author Andrea Fiori
 * @since  21 February 2015
 */
class RedbeanHelper
{
    /**
     * @param string $q
     * @return array
     */
    public function getRecord($q)
    {
        try {
            return R::getAll($q);
        }  catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * @param string $q
     * @return int|string
     */
    public function executeQuery($q)
    {
        R::begin();
        try {
            $result = R::exec($q);
            R::commit();
            return $result;
        }  catch (Exception $ex) {
            R::rollback();
            return $ex->getMessage();
        }
    }

    /**
     * @param array $q
     * @return bool
     */
    public function executeMultipleQuery(array $q)
    {
        foreach ($q as $query) {
            R::begin();
            try {
                R::exec($q);
                R::commit();
                return true;
            } catch (Exception $ex) {
                R::rollback();
                return false;
            }
        }

        return false;
    }
}