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


    private $_modelName;

    public function __construct($model, $attribute, $options = array())
    {
        $this->id = $attribute;
        $this->model = $model;
        $this->attribute = $attribute;
        $this->options = $options;
    }

    abstract public function renderFilter();

    abstract public function executeQuery($activeQuery);

    public function getAttributeLabel()
    {
        return Html::activeLabel($this->model, $this->getAttribute());
    }

    public function getModelName()
    {
        if (isset($this->_modelName) == false) {
            $this->_modelName = (new \ReflectionClass($this->model))->getShortName();
        }
        return $this->_modelName;
    }

    public function getInputName()
    {
        return $this->_modelName . '[' . $this->attribute . ']';
    }

    /**
     * Return Http Form Get Value
     * @return string
     */
    public function getInputValue()
    {
        return isset($_GET[$this->getModelName()][$this->attribute]) ? $_GET[$this->getModelName()][$this->attribute] : '';
    }


    /**
     * Return
     * @return string
     */
    public function getAttribute($full = false)
    {
        if ($full == true)
            return $this->attribute;
        $temp_array = explode('.', $this->attribute);
        return end($temp_array);
    }

    public function getRelations()
    {
        $relations = explode('.', $this->attribute);
        $last_item = end($relations);

        $data = array();
        if (count($relations) > 1) {
            foreach ($relations as $item) {
                if ($item != $last_item) {
                    if (empty($data)) {
                        $data[] = $item;
                    } else {
                        $data[] = current($data) . '.' . $item;
                    }
                }
            }
        }
        return $data;
    }

    public function getActiveRelation()
    {
        $relations = explode('.', $this->attribute); //category.country.id_country
        $last_item = end($relations);
        $key = array_search($last_item, $relations);
        unset($relations[$key]); //unset $id_country
        return end($relations); // country

    }

    public function getAttributeWithActiveRelation()
    {
        return $this->getActiveRelation() . '.' . $this->getAttribute();
    }

}
