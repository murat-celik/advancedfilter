<?php

namespace advancedfilter\src\filters;

use advancedfilter\src\base\Filter;
use yii\helpers\Html;

/**
 * Description of DropdownFilter
 *
 * @author Murat Çelik
 */
class DropdownFilter extends Filter
{

    /**
     * @var array
     */
    public $items = array();

    public function __construct($model, $attribute, $items = array(), $options) {
        parent::__construct($model, $attribute, $options);
        $this->items = $items;
    }

    public function renderFilter() {
        return Html::activeDropDownList($this->model, $this->getAttribute(), $this->items, $this->options);
    }

    public function executeQuery($activeQuery) {
        return $activeQuery->andFilterCompare($this->attribute, $this->model->{$this->getAttribute()});
    }

}
