<?php

namespace advancedfilter\src\filters;

use advancedfilter\src\base\Filter;
use yii\helpers\Html;

/**
 * Description of TextFilter
 *
 * @author Murat Çelik
 */
class TextRelationFilter extends Filter
{

    /**
     * @var Boolean
     */
    public $escape = false;

    public function __construct($model, $attribute, $escape = false, $options)
    {
        parent::__construct($model, $attribute, $options);
        $this->escape = $escape;
    }

    public function renderFilter()
    {
        return Html::input('text', $this->getInputName(), $this->getInputValue(), $this->options);
    }

    public function executeQuery($activeQuery)
    {
        if ($this->escape == true) {
            return $activeQuery->joinWith($this->getRelations())->andFilterWhere(['like', $this->attribute, $this->getInputValue()]);
        }
        $activeQuery->joinWith($this->getRelations())->andFilterCompare($this->getAttributeWithActiveRelation(), $this->getInputValue());

        return $activeQuery;// exit;
    }







}
