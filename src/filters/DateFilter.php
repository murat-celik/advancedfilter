<?php

namespace advancedfilter\src\filters;

use advancedfilter\src\base\Filter;
use yii\helpers\Html;

/**
 * Description of DateFilter
 *
 * @author Murat Çelik
 */
class DateFilter extends Filter
{

    public function __construct($model, $attribute, $options = array()) {
        parent::__construct($model, $attribute, $options);
    }

    public function renderFilter() {
        return Html::activeInput('date', $this->model, $this->attribute, $this->options);
    }

    public function executeQuery($activeQuery){
        if (isset($this->model->{$this->attribute})) {
            $this->model->{$this->attribute} = date('Y-m-d', strtotime($this->model->{$this->attribute}));
        }

        return $activeQuery->andFilterCompare($this->attribute, $this->model->{$this->attribute});
    }
}
