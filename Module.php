<?php

namespace soless\quiz;

class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'soless\quiz\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if (\Yii::$app instanceof \yii\console\Application) {
            $this->controllerNamespace = 'soless\quiz\commands';
        }

        // custom initialization code goes here
    }
}
