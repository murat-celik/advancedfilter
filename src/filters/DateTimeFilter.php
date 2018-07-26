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

    public function __construct($model, $attribute, $options = array()) {
        if (!empty($options)) {
            $options = array_merge($options, array('class' => 'form-control input-sm'));
        } else {
            $options = array('class' => 'form-control input-sm');
        }
        parent::__construct($model, $attribute, $options);
    }

    public function renderFilter() {
        return Html::activeInput('datetime-local', $this->model, $this->attribute, $this->options);
    }

    public function executeQuery($activeQuery){
        if (isset($this->model->{$this->attribute})) {
            $this->model->{$this->attribute} = date('Y-m-d H:i', strtotime($this->model->{$this->attribute}));
        }
        return $activeQuery->andFilterCompare($this->attribute, $this->model->{$this->attribute});
    }

}
