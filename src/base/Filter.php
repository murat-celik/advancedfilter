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
     *
     * @var type string
     */
    public $id;

    /**
     *
     * @var type \yii\db\ActiveRecord
     */
    public $model;

    /**
     *
     * @var type string
     */
    public $attribute;

    /**
     *
     * @var type array();
     */
    public $options;

    /**
     *
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
