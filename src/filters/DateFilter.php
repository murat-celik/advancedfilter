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
    public function renderFilter()
    {
        return Html::input('date', $this->getInputName(), $this->getInputValue(), $this->options);
    }

    public function executeQuery($activeQuery)
    {
        $value = $this->getInputValue();
        if (isset($value) && $value != '') {
            $value = date('Y-m-d', strtotime($value));
        }
        return $activeQuery->joinWith($this->getRelations())->andFilterCompare($this->getAttributeWithActiveRelation(), $value);
    }
}
