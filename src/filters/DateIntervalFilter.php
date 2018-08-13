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
    public function renderFilter()
    {
        return Html::input('date', $this->getInputNameByType('start'), $this->getInputValueByType('start'), $this->options)
            . '<span class="help-block" style="margin: 0px !important;">start</span>' .
            Html::input('date', $this->getInputNameByType('finish'), $this->getInputValueByType('finish'), $this->options)
            . '<span class="help-block" style="margin: 0px !important;">finish</span>';
    }

    public function executeQuery($activeQuery)
    {
        $start = $this->getInputValueByType('start');
        if (isset($start) && $start != '') {
            $start = date('Y-m-d', strtotime($start));
        }

        $finish = $this->getInputValueByType('finish');
        if (isset($finish) && $finish != '') {
            $finish = date('Y-m-d', strtotime($finish));
        }
        
        if (isset($start) && $start!='' && isset($finish) && $finish!='') {
            return $activeQuery->joinWith($this->getRelations())->where(['between', $this->getAttributeWithActiveRelation(), $start, $finish]);
        }

        return $activeQuery;

    }

    public function getInputNameByType($type)
    {
        return $this->getModelName() . '[' . $this->attribute . '_' . $type . ']';
    }

    public function getInputValueByType($type)
    {
        if (isset($_GET[$this->getModelName()][$this->attribute . '_' . $type])) {
            $value = strip_tags($_GET[$this->getModelName()][$this->attribute . '_' . $type]);
            //$value = Yii::$app->db->quoteValue($value);
            return $value;
        }
        return null;
    }
}