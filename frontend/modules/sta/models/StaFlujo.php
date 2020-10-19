<?php

namespace frontend\modules\sta\models;
use yii\web\NotFoundHttpException;
use Yii;

/**
 * This is the model class for table "{{%sta_flujo}}".
 *
 * @property int $id
 * @property string $codperiodo
 * @property int $mes
 * @property int $actividad
 * @property int $gactividad
 * @property string $proceso
 * @property int $nsesiones
 * @property string $esevento
 * @property string $detalle
 *
 * @property StaPeriodos $codperiodo0
 */
class StaFlujo extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public $booleanFields=['esevento'];
    
    public static function tableName()
    {
        return '{{%sta_flujo}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codperiodo', 'mes', 'actividad', 'proceso', 'nsesiones'], 'required'],
            [['mes', 'actividad', 'gactividad', 'nsesiones'], 'integer'],
            [['detalle'], 'string'],
            [['codperiodo'], 'string', 'max' => 7],
            [['proceso'], 'string', 'max' => 40],
            [['esevento'], 'string', 'max' => 1],
            [['codperiodo'], 'exist', 'skipOnError' => true, 'targetClass' => StaPeriodos::className(), 'targetAttribute' => ['codperiodo' => 'codperiodo']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('sta.labels', 'ID'),
            'codperiodo' => Yii::t('sta.labels', 'Codperiodo'),
            'mes' => Yii::t('sta.labels', 'Mes'),
            'actividad' => Yii::t('sta.labels', 'Actividad'),
            'gactividad' => Yii::t('sta.labels', 'Gactividad'),
            'proceso' => Yii::t('sta.labels', 'Proceso'),
            'nsesiones' => Yii::t('sta.labels', 'Nsesiones'),
            'esevento' => Yii::t('sta.labels', 'Esevento'),
            'detalle' => Yii::t('sta.labels', 'Detalle'),
        ];
    }

    /**
     * Gets query for.
     *
     * 
     */
    public function getCodperiodo0()
    {
        return $this->hasOne(StaPeriodos::className(), ['codperiodo' => 'codperiodo']);
    }

    /**
     * {@inheritdoc}
     * @return StaFlujoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StaFlujoQuery(get_called_class());
    }
    
    /*
     * Devuelve el ultimo registro de la tabla staFlujo
     * que no es evento
     */
    public static  function lastRecord($codperiodo=null){
       if(is_null($codperiodo)){
         $codperiodo=\frontend\modules\sta\staModule::getCurrentPeriod();
        } 
       $lastId= static::find()->select('max(id)')->where([
           'codperiodo'=>$codperiodo,
           'esevento'=>'0'
               ])->scalar();
      if($lastId===false){
          static::firstRecord();
      }
       return static::findOne($lastId);
    }
    /*
     * Devuelve el primer  registro de la tabla staFlujo
     * que no es evento
     */ 
   public static  function firstRecord($codperiodo=null){
       if(is_null($codperiodo)){
         $codperiodo=\frontend\modules\sta\staModule::getCurrentPeriod();
        } 
       $firstId= static::find()->select('min(id)')->where([
           'codperiodo'=>$codperiodo,
           'esevento'=>'0'
               ])->scalar();
      if($firstId===false){
           throw new NotFoundHttpException(Yii::t('sta.labels', 'El periodo no tiene flujo de trabajo o solo hay etapas eventos'));
      }
       return static::findOne($firstId);
    }
/*
 * Devuelve el siguietne registro 
 * de la tabl staflujo
 */
    public function nextActividad($codperiodo=null){
         if(is_null($codperiodo)){
         $codperiodo=\frontend\modules\sta\staModule::getCurrentPeriod();
        } 
      $reg=static::find()->where(['>','actividad',$this->actividad])->
              andWhere([
                  'codperiodo'=>$codperiodo,
           'esevento'=>'0'])->orderBy('actividad asc')->one();
      if(is_null($reg)){
          return  static::lastRecord($codperiodo)->actividad;
      }else{
          return $reg->actividad;
      }
    }
}