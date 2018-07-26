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
        return Html::activeCheckbox($this->model, $this->attribute, $this->options);
    }

    public function executeFilter() {
        return $this->activeQuery->andFilterCompare($this->attribute, $this->model->{$this->attribute});
    }

}
