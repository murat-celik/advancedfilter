<?php

namespace advancedfilter\src\filters;

use advancedfilter\src\base\Filter;
use yii\helpers\Html;

/**
 * Description of DateFilter
 *
 * @author Murat Çelik
 */
class TimeFilter extends Filter
{
    public function renderFilter()
    {
        return Html::input('time', $this->getInputName(), $this->getInputValue(), $this->options);
    }

    public function executeQuery($activeQuery)
    {
        $value = $this->getInputValue();
        if (isset($value) && $value != '') {
            $value = date('H:i', strtotime($value));
        }
        $attr = $this->getAttributeWithActiveRelation();
        if ($value) {
            return $activeQuery->joinWith($this->getRelations())->andWhere("DATE_FORMAT(" . $attr . ", '%H:%i')='$value'");
        }
        return $activeQuery;
    }
}
