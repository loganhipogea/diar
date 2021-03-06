<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\sigi\models\SigiCargos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sigi-cargos-form">
    <br>
    <?php $form = ActiveForm::begin([
    'fieldClass'=>'\common\components\MyActiveField'
    ]); ?>
    
    
    
    
    
      <div class="box-header">
        <div class="col-md-12">
            <div class="form-group no-margin">
                
        <?= Html::submitButton('<span class="fa fa-save"></span>   '.Yii::t('sigi.labels', 'Guardar'), ['class' => 'btn btn-success']) ?>
        <?=(!$model->isNewRecord)?common\widgets\auditwidget\auditWidget::widget(['model'=>$model]):''?>
           
            </div>
        </div>
    </div>
      <div class="box-body">
    
 
  <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
     <?= $form->field($model, 'codcargo')->textInput(['maxlength' => true,'disabled'=>(!$model->isNewRecord)?true:false]) ?>

 </div>
  <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
     <?= $form->field($model, 'descargo')->textInput(['maxlength' => true]) ?>

 </div>
  
  <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
     <?= $form->field($model, 'regular')->checkBox([]) ?>

 </div>
     
    <?php ActiveForm::end(); ?>

</div>
    </div>
