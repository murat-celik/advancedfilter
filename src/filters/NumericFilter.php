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

    public function __construct($model, $attribute, $activeQuery, $options = array('class' => 'form-control input-sm', 'type' => 'number')) {
        parent::__construct($model, $attribute, $activeQuery, $options);

    }

    public function drawFilter() {
        return Html::activeTextInput($this->model, $this->attribute, $this->options);
    }

    public function executeFilter() {
        return $this->activeQuery->andFilterCompare($this->attribute, $this->model->{$this->attribute});
    }

}
