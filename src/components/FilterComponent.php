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

    public function render($filters, $panelTitle = '', $columnCount = 3, $render = true)
    {
        if ($render) {
            $view_file = Yii::$app->basePath . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'advancedfilter' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . '_filter_panel_form.php';
            return Yii::$app->controller->renderFile($view_file, array('filters' => $filters, 'panelTitle' => $panelTitle, 'columnCount' => $columnCount));
        }
    }

}
