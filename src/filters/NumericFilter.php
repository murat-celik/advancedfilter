<?php

namespace advancedfilter\src\filters;

use advancedfilter\src\base\Filter;
use yii\helpers\Html;

/**
 * Description of NumericFilter
 *
 * @author Murat Çelik
 */
class NumericFilter extends Filter
{

    public function __construct($model, $attribute, $options = array()) {
        if (!empty($options)) {
            $options = array_merge($options, array('class' => 'form-control input-sm', 'type' => 'number'));
        } else {
            $options = array('class' => 'form-control input-sm', 'type' => 'number');
        }
        parent::__construct($model, $attribute, $options);

    }

    public function renderFilter() {
        return Html::activeTextInput($this->model, $this->attribute, $this->options);
    }

    public function executeQuery($activeQuery) {
        return $activeQuery->andFilterCompare($this->attribute, $this->model->{$this->attribute});
    }

}
