<?php

namespace advancedfilter\src\filters;

use advancedfilter\src\base\Filter;
use yii\helpers\Html;

/**
 * Description of BooleanFilter
 *
 * @author Murat Çelik
 */
class BooleanFilter extends Filter
{

    public function renderFilter() {
        $this->options['label']='';
        return Html::activeCheckbox($this->model,$this->attribute, $this->options);
    }

    public function executeQuery($activeQuery) {
        return $activeQuery->andFilterCompare($this->getAttribute(), $this->getInputValue());
    }

}
