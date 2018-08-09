<?php

namespace advancedfilter\src\filters;

/**
 * Description of TextRelationFilter
 *
 * @author Murat Çelik
 */
class TextRelationFilter extends  \advancedfilter\src\filters\TextFilter
{
    public function executeQuery($activeQuery)
    {
        if ($this->escape == true) {
            return $activeQuery->joinWith($this->getRelations(),true)->andFilterWhere(['like', $this->getAttributeWithActiveRelation(), $this->getInputValue()]);
        }
        $activeQuery->joinWith($this->getRelations())->andFilterCompare($this->getAttributeWithActiveRelation(), $this->getInputValue());

        return $activeQuery;// exit;
    }
}
