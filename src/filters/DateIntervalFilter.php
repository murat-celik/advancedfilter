<?php
/**
 * Created by PhpStorm.
 * User: muratcelik
 * Date: 9.08.2018
 * Time: 13:34
 */

namespace advancedfilter\src\filters;

use advancedfilter\src\base\Filter;
use yii\helpers\Html;

class DateIntervalFilter extends Filter
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