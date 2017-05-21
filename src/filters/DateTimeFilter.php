<?php

namespace advancedfilter\src\filters;

use advancedfilter\src\base\Filter;
use yii\helpers\Html;

/**
 * Description of DateTimeFilter
 *
 * @author Murat Çelik
 */
class DateTimeFilter extends Filter
{

    public function __construct($model, $attribute, $activeQuery, $options = array()) {
        if (!empty($options)) {
            $options = array_merge($options, array('class' => 'form-control input-sm', 'type' => 'datetime-local'));
        } else {
            $options = array('class' => 'form-control input-sm', 'type' => 'date');
        }
        parent::__construct($model, $attribute, $activeQuery, $options);
    }

    public function drawFilter() {
        return Html::activeTextInput($this->model, $this->attribute, $this->options);
    }

    public function executeFilter(){
        if (isset($this->model->{$this->attribute})) {
            $this->model->{$this->attribute} = date('Y-m-d', strtotime($this->model->{$this->attribute}));
        }
        return $this->activeQuery->andFilterCompare($this->attribute, $this->model->{$this->attribute});
    }

}
