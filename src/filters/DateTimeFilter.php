<?php

namespace advancedfilter\src\filters;

use advancedfilter\src\base\Filter;
use yii\helpers\Html;

/**
 * Description of DateTimeFilter
 *
 * @author Murat Çelik
 */
class DateTimeFilter extends Filter
{
    public function renderFilter()
    {
        return Html::input('datetime-local', $this->getInputName(), $this->getInputValue(), $this->options);
    }

    public function executeQuery($activeQuery)
    {
        $value = $this->getInputValue();
        if (isset($value) && $value != '') {
            $value = date('Y-m-d H:i', strtotime($value));
        }
        $attr = $this->getAttributeWithActiveRelation();
        if ($value){
            return $activeQuery->joinWith($this->getRelations())->andWhere("DATE_FORMAT(" . $attr . ", '%Y-%m-%d %H:%i')='$value'");
        }
        return $activeQuery;

    }

}
