<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/**
 * @var $filter advancedfilter\src\base\Filter;
 */
?>

<?php
$form = ActiveForm::begin([
    'enableAjaxValidation' => FALSE,
    'enableClientValidation' => FALSE,
    'method' => 'GET',
    'action' => Url::toRoute(\Yii::$app->request->getPathInfo())
]);


?>
    <div class="panel panel-default">
        <?php if (isset($panelTitle) && strlen($panelTitle) > 0): ?>
            <div class="panel-heading">
                <h3 class="panel-title"><?= $panelTitle ?></h3>
            </div>
        <?php endif; ?>

        <div class="panel-body">
            <div class="row">
                <?php foreach ($filters as $key => $filter): ?>
                    <div class="col-lg-<?= $columnCount ?> col-md-<?= $columnCount ?>">
                        <div class="form-group">

                            <?php echo $filter->getAttributeLabel()?>
                            <?= $filter->renderFilter(); ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="panel-footer">
            <?= Html::submitButton('Search', ['class' => 'btn btn-primary btn-xs']); ?>
            <?= Html::button('Refresh', ['class' => 'btn btn-info btn-xs', 'onclick' => "location.href='" . Url::toRoute(\Yii::$app->request->getPathInfo()) . "'"]) ?>
            <?= Html::resetButton('Reset', ['class' => 'btn btn-default btn-xs']); ?>
        </div>
    </div>

<?php ActiveForm::end(); ?>