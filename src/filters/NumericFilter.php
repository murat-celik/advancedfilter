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
        parent::__construct($model, $attribute, $options);

    }

    public function renderFilter() {
        return Html::activeInput('number', $this->model, $this->attribute, $this->options);
    }

    public function executeQuery($activeQuery) {
        return $activeQuery->andFilterCompare($this->attribute, $this->model->{$this->attribute});
    }

}
