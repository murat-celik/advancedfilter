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
        return Html::checkbox($this->getInputName(),$this->getInputValue(), $this->options);
    }

    public function executeQuery($activeQuery)
    {
        return  $activeQuery->joinWith($this->getRelations())->andFilterCompare($this->getAttributeWithActiveRelation(), $this->getInputValue());
    }
}
