<?php

namespace app\components;

use yii\base\BaseObject;

/**
 * Class Job
 * @package app\components
 */
class Job extends BaseObject implements \yii\queue\JobInterface
{
    /**
     * @var CadasterInterface $cadaster
     */
    public $cadaster;

    public function execute($queue)
    {
        $apiRosreestr = \Yii::$app->get('apiRosreestr');
        $reestrRow = $apiRosreestr->getCadasterSearch($this->cadaster->getAddress());

        if (count($reestrRow->objects) > 0) {
            $this->cadaster->setCadastralNumber($reestrRow->objects[0]->CADNOMER);
            $this->cadaster->setArea($reestrRow->objects[0]->AREA);
            $this->cadaster->save();
        }
    }
}