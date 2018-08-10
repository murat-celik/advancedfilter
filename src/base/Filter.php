<?php

namespace advancedfilter\src\base;

use Yii;
use yii\helpers\Html;

/**
 * Description of Filter
 *
 * @author Murat Çelik
 */
abstract class Filter
{
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
     * @var string
     */
    private $_modelName = null;

    /**
     * Filter constructor.
     * @param $model
     * @param $attribute
     * @param array $options
     */
    public function __construct($model, $attribute, $options = array())
    {
        $this->model = $model;
        $this->attribute = $attribute;
        $this->options = $options;
    }

    /**
     * @return string
     */
    abstract public function renderFilter();

    /**
     * @param $activeQuery yii\db\ActiveQuery;
     * @return yii\db\ActiveQuery;
     */
    abstract public function executeQuery($activeQuery);

    public function getAttributeLabel()
    {
        return Html::activeLabel($this->model, str_replace('t.','',$this->getAttribute(true)) );
    }

    public function getModelName()
    {
        if (isset($this->_modelName) == false) {
            $this->_modelName = (new \ReflectionClass($this->model))->getShortName();
        }

        return $this->_modelName;
    }

    /**
     * @return string
     */
    public function getInputName()
    {
        return $this->getModelName() . '[' . $this->attribute . ']';
    }

    /**
     * Return Http Form Get Value
     * @return string
     */
    public function getInputValue()
    {
        if (isset($_GET[$this->getModelName()][$this->attribute])){
            $value =  strip_tags($_GET[$this->getModelName()][$this->attribute]);
            //$value = Yii::$app->db->quoteValue($value);
            return $value;
        }
        return null;
    }

    /**
     * when attribute = post.author.user.fullname will return fullname
     * when $full  = true will return  post.author.user.fullname
     * @param bool $full
     * @return string
     */
    public function getAttribute($full = false)
    {
        if ($full == true)
            return $this->attribute;
        $temp_array = explode('.', $this->attribute);
        return end($temp_array);
    }

    /**
     * when attribute = post.author.user.fullname will  return array( 'post','post.author','post.author.user')
     * @return array
     */
    public function getRelations()
    {

        $relations = explode('.',str_replace('t.','',$this->attribute) );
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
    
    /**
     * when attribute = post.author.user.fullname will return return user
     * @return string
     */
    public function getActiveRelation()
    {
        $relations = explode('.', $this->attribute);
        if (count($relations)==1){
            return null;
        }
        $last_item = end($relations);
        $last_item_key = array_search($last_item, $relations);
        unset($relations[$last_item_key]); //unset id_country

        return end($relations); // country
    }

    /**
     * when attribute = post.author.user.fullname will user.fullname
     * @return string
     */
    public function getAttributeWithActiveRelation()
    {
        $active_relation = $this->getActiveRelation();

        if ($active_relation ==null){
            return $this->getAttribute();
        }

        return $this->getActiveRelation() . '.' . $this->getAttribute();
    }

}
