<?php

namespace app\components;

class CadasterNumberSearcher
{
    /**
     * @param CadasterInterface $cadaster
     */
    public function addForSearch(CadasterInterface $cadaster)
    {
        $job = new Job([
            'cadaster' => $cadaster
        ]);

        \Yii::$app->queue->push($job);
    }
}