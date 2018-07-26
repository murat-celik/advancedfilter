<?php

namespace advancedfilter\src\components;

use Yii;
use yii\base\Component;

/**
 * Description of FilterComponent
 *
 * @author Murat Çelik
 */
class FilterComponent extends Component
{

    /**
     * @var \advancedfilter\src\base\Filter[]
     */
    public $filters = array();

    /**
     * @var string
     */
    public $panelTitle;

    /**
     * @var type integer
     */
    public $columnCount;

    public function render($filters, $panelTitle = '', $columnCount = 4)
    {
        $this->filters = $filters;
        $this->panelTitle = $panelTitle;
        $this->columnCount = $columnCount;

        $view_file = Yii::$app->basePath . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'advancedfilter' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . '_filter_panel_form.php';
        return Yii::$app->controller->renderFile($view_file, array('panelTitle' => $this->panelTitle, 'filters' => $this->filters, 'columnCount' => $this->columnCount));
    }

}
