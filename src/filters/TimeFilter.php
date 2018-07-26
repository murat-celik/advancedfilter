<?php

namespace advancedfilter\src\filters;

use advancedfilter\src\base\Filter;
use yii\helpers\Html;

/**
 * Description of DateFilter
 *
 * @author Murat Çelik
 */
class TimeFilter extends Filter
{
    public function __construct($model, $attribute, $options = array()) {
        if (!empty($options)) {
            $options = array_merge($options, array('class' => 'form-control input-sm', 'type' => 'time'));
        } else {
            $options = array('class' => 'form-control input-sm', 'type' => 'time');
        }
        parent::__construct($model, $attribute, $options);
    }

    public function renderFilter() {
        return Html::activeTextInput($this->model, $this->attribute, $this->options);
    }

    public function executeQuery($activeQuery){
        if (isset($this->model->{$this->attribute})) {
            $this->model->{$this->attribute} = date('H:i', strtotime($this->model->{$this->attribute}));
        }

        return $activeQuery->andFilterCompare($this->attribute, $this->model->{$this->attribute});
    }

}
