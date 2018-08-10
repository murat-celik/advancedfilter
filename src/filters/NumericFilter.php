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
    public function renderFilter()
    {
        return Html::input('number', $this->getInputName(), $this->getInputValue(), $this->options);
    }

    public function executeQuery($activeQuery)
    {
        return $activeQuery->joinWith($this->getRelations())->andFilterCompare($this->getAttributeWithActiveRelation(), $this->getInputValue());
    }
}
