<?php

namespace frontend\modules\sigi\models;

/**
 * This is the ActiveQuery class for [[VwSigiKardexdepa]].
 *
 * @see VwSigiKardexdepa
 */
class VwSigiKardexdepaQuery extends \frontend\modules\sigi\components\ActiveQueryScope
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return VwSigiKardexdepa[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return VwSigiKardexdepa|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
