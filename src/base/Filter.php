<?php

namespace advancedfilter\src\base;

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

    /**
     * @var yii\db\ActiveQuery; 
     */
    public $activeQuery;

    public function __construct($model, $attribute, $activeQuery, $options = array()) {
        $this->id = $attribute;
        $this->model = $model;
        $this->attribute = $attribute;
        $this->activeQuery = $activeQuery;
        $this->options = $options;
    }

    abstract public function drawFilter();

    abstract public function executeFilter();
}
