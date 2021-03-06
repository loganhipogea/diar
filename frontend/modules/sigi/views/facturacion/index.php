<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;
/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\sigi\models\SigiFacturacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('sigi.labels', 'Facturación');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sigi-facturacion-index">

    <h4><?= Html::encode($this->title) ?></h4>
    <div class="box box-success">
     <div class="box-body">
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('sigi.labels', 'Nueva facturacion'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div style='overflow:auto;'>
    <?php
     $gridColumns=[
        [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
                'buttons' => [
                    'update' => function($url, $model) {                        
                        $options = [
                            'title' => Yii::t('base.verbs', 'Update'),                            
                        ];
                        return Html::a('<span class="btn btn-info btn-sm glyphicon glyphicon-pencil"></span>', $url, $options/*$options*/);
                         },
                          'view' => function($url, $model) {                        
                        $options = [
                            'title' => Yii::t('base.verbs', 'View'),                            
                        ];
                        return Html::a('<span class="btn btn-warning btn-sm glyphicon glyphicon-search"></span>', $url, $options/*$options*/);
                         },
                         'delete' => function($url, $model) {                        
                        $options = [
                            'data-confirm' => Yii::t('rbac-admin', 'Are you sure you want to activate this user?'),
                            'title' => Yii::t('base.verbs', 'Delete'),                            
                        ];
                        return Html::a('<span class="btn btn-danger btn-sm glyphicon glyphicon-remove"></span>', $url, $options/*$options*/);
                         }
                    ]
                ],
         
         
         
         
         

           [
                'attribute'=>'edificio_id',
                'filter'=>frontend\modules\sigi\helpers\comboHelper::getCboEdificios(),
                'value' => function($model) { 
                        //var_dump($model);die();
                        return $model->edificio->nombre ;
                         },
                 'group'=>true,   
            ],
            'mes',
                                 
            'ejercicio',
            'fecha',
            'descripcion',
           [
                'attribute'=>'monto',
                //'filter'=>frontend\modules\sigi\helpers\comboHelper::getCboEdificios(),
                'value' => function($model) { 
                        //var_dump($model);die();
                        return Yii::$app->formatter->asDecimal($model->montoTotal(),3) ;
                         },
                 'group'=>true,   
            ],
            //'descripcion',
            //'detalles:ntext',

          
        ];
    
    echo ExportMenu::widget([
    'dataProvider' => $dataProvider,
    'filename'=>yii::t('sigi.labels','Detalles de facturación'),
    'columns' => $gridColumns,
    'dropdownOptions' => [
        'label' => yii::t('sta.labels','Exportar'),
        'class' => 'btn btn-success'
    ]
]) . "<br><hr>\n".GridView::widget([
        'dataProvider' =>$dataProvider,
         'summary' => '',
    'filterModel' => $searchModel,
         'showPageSummary' => true,
         'tableOptions'=>['class'=>'table table-condensed table-hover table-bordered table-striped'],
        //'filterModel' => $searchModel,
        'columns' => $gridColumns,
    ]); ?>
    <?php Pjax::end(); ?>
</div>
    </div>
</div>
    </div>
       