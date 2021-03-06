<?php
/*
 * Esta clase para ahorrar tiempo
 * Evitando escribir Yii::$app->
 */
namespace common\helpers;
use yii;

class timeHelper {
     
    public static function getMaxTimeExecute(){
      return ini_get('max_execution_time')+0; 
   }
   
   public static function excedioDuracion($duration, $anticipate=0){
      return ($duration + $anticipate >= static::getMaxTimeExecute());
   }
   
   public STATIC function daysOfWeek(){
       return [
           0=>yii::t('base.names','Domingo'),
           1=>yii::t('base.names','Lunes'),
           2=>yii::t('base.names','Martes'),
           3=>yii::t('base.names','Miercoles'),
           4=>yii::t('base.names','Jueves'),
           5=>yii::t('base.names','Viernes'),
           6=>yii::t('base.names','Sabado'),
        
           
       ];
   }
   
   
   public static  function cboAnnos(){
       return [
           '2018'=>'2018',
            '2019'=>'2019',
            '2020'=>'2020',
           '2021'=>'2021',
           '2022'=>'2022',
       ];
   }
 
   
    public static  function cboMeses($textos=false){
        if(!$textos)
       return [
           '1'=>yii::t('base.names','ENERO'),
           '2'=>yii::t('base.names','FEBRERO'),
           '3'=>yii::t('base.names','MARZO'),
           '4'=>yii::t('base.names','ABRIL'),
           '5'=>yii::t('base.names','MAYO'),
           '6'=>yii::t('base.names','JUNIO'),
           '7'=>yii::t('base.names','JULIO'),
           '8'=>yii::t('base.names','AGOSTO'),
           '9'=>yii::t('base.names','SETIEMBRE'),
           '10'=>yii::t('base.names','OCTUBRE'),
           '11'=>yii::t('base.names','NOVIEMBRE'),
           '12'=>yii::t('base.names','DICIEMBRE'),
       ];
       return [
           '01'=>yii::t('base.names','ENERO'),
           '02'=>yii::t('base.names','FEBRERO'),
           '03'=>yii::t('base.names','MARZO'),
           '04'=>yii::t('base.names','ABRIL'),
           '05'=>yii::t('base.names','MAYO'),
           '06'=>yii::t('base.names','JUNIO'),
           '07'=>yii::t('base.names','JULIO'),
           '08'=>yii::t('base.names','AGOSTO'),
           '09'=>yii::t('base.names','SETIEMBRE'),
           '10'=>yii::t('base.names','OCTUBRE'),
           '11'=>yii::t('base.names','NOVIEMBRE'),
           '12'=>yii::t('base.names','DICIEMBRE'),
       ]; 
   }
   
   public static function mapMonths($arrayIntegers){
       $arr=[];
       foreach($arrayIntegers as $key=>$value){
           $arr[$value]=substr(static::cboMeses()[$value],0,3);
       }
       return $arr;
   }
   
   public static function mes($nmes){
       $meses=static::cboMeses();
       return $meses[$nmes];
   }
   
   public static function getDateTimeInitial(){
       return '1970-01-01 00:00:00';
   }
   public static function getDateInitial(){
       return '1970-01-01';
   }
   
   public static function formatMysql(){
    return h::gsetting('timeBD', 'datetime');
   } 
   
   public static function formatMysqlDate(){
    return 'Y-m-d';
   } 
   public static function formatMysqlDateTime(){
    return 'Y-m-d H:i:s';
   } 
   
   public static function regexMysqlDate(){
      return '/[0-9]{4}-[0-1]{1}[0-9]{1}-[0-3]{1}[0-9]{1}/';
  }
  public static function regexMysqlDateTime(){
      return '/[0-9]{4}-[0-1]{1}[0-9]{1}-[0-3]{1}[0-9]{1} [0-2]{1}[0-9]{1}:[0-5]{1}[0-9]{1}:[0-5]{1}[0-9]{1}/';
  }
  public static function IsFormatMysqlDate($fecha){
     if(preg_match(static::regexMysqlDateTime(),$fecha)){
         return true;
     }else{
         return false;
     }
  }
  public static function IsFormatMysqlDateTime($fecha){
     if(preg_match(static::regexMysqlDateTime(),$fecha)){
         return true;
     }else{
         return false;
     }
  }
  
  public static function Saludo(){
      $hora=Date('H');
      if ($hora <= 12)
          return yii::t('base.names','Buenos d??as');
        else if ($hora < 19)
          return yii::t('base.names','Buenas Tardes');
        else
         return yii::t('base.names','Buenas Noches');
  }
  
  public static function semanas(){
      $semanas=[];
      for ($i = 1; $i <= 52; $i++) {
          $semanas[$i]='Semana '.$i;
         }
       return $semanas;
    }
    
 public static function previousMonth($mes){
     if(!is_int($mes))$mes=(Integer)$mes;
     //if($mes==12)return 1;
     if($mes==1)return 12;
     return $mes-1;
 } 
 public static function nextMonth($mes){
     if(!is_int($mes))$mes=(Integer)$mes;
     if($mes==12)return 1;
     //if($mes==1)return 12;
     return $mes+1;
 }
 
 private static function mesesdias($anio){
     $dfebrero=(($anio+0)%4==0)?29:28;
     return [
         1=>31,
         2=>$dfebrero,
         3=>31,
         4=>30,
         5=>31,        
         6=>30,
         7=>31,
         8=>31,
         9=>30,
         10=>31,        
         11=>30,
         12=>31,
     ];
 }
     
 public static function maxDayMes($mes,$anio){
     return self::mesesdias($anio)[$mes];
 }

/*
 * RETORNA UNA MATRIZ CON DOS FECHAS
 * LA FECHA INCIO Y LA FECHA FINAL DEL
 * PERIOD MENSUAL
 * $show: meustr el foramto de salida 
 */
 public static function bordersDay($mes,$anio){
     //$mesSiguiente= str_pad(timeHelper::nextMonth($mes), 2, '0', STR_PAD_LEFT);
      $mes=str_pad(($mes+0).'', 2, '0', STR_PAD_LEFT);
      $fechaini=$anio.'-'.$mes.'-01';
      $fechafin=$anio.'-'.$mes.'-'.str_pad(self::maxDayMes($mes+0,$anio), 2, '0', STR_PAD_LEFT);
      return [$fechaini,$fechafin];
 }
}  
  
   
