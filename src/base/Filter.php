<?php

namespace advancedfilter\src\base;

use yii\helpers\Html;

/**
 * Description of Filter
 *
 * @author Murat Çelik
 */
abstract class Filter
{

    /**
     * @var string
     */
    public $id;

    /**
     * @var \yii\db\ActiveRecord
     */
    public $model;

    /**
     * @var string
     */
    public $attribute;

    /**
     * @var array
     */
    public $options;


    public function __construct($model, $attribute, $options = array()) {
        $this->id = $attribute;
        $this->model = $model;
        $this->attribute = $attribute;
        $this->options = $options;
    }

    abstract public function renderFilter();

    abstract public function executeQuery($activeQuery);

    public function getAttributeLabel(){
        return  Html::activeLabel($this->model,$this->attribute);
    }
}
