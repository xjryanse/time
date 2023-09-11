<?php

namespace xjryanse\time\service;

use xjryanse\system\interfaces\MainModelInterface;
use xjryanse\logic\Arrays;
use xjryanse\logic\Datetime;
use xjryanse\logic\DataCheck;
use Exception;

/**
 * 
 */
class TimeDailyService extends Base implements MainModelInterface {

    use \xjryanse\traits\InstTrait;
    use \xjryanse\traits\MainModelTrait;
    use \xjryanse\traits\MainModelQueryTrait;

    protected static $mainModel;
    protected static $mainModelClass = '\\xjryanse\\time\\model\\TimeDaily';
    
    public static function extraPreSave( &$data,$uuid){
        self::stopUse(__METHOD__);
    }
    
    public static function extraPreUpdate( &$data,$uuid){
        self::stopUse(__METHOD__);
    }
    
    public static function ramPreSave( &$data,$uuid){
        $keys = ['time_key','full_date'];
        DataCheck::must($data, $keys);
    }
    
    /**
     * 20230526:按条件提取单条记录
     * 未提取到数据时，返回不带id的预填数据（方便前端提交更新）
     * @param type $param
     */
    public static function findOneWithPre($param){
        $timeKey    = Arrays::value($param, 'time_key');
        // 年月
        $yearmonth  = Arrays::value($param, 'yearmonth');
        // 日
        $date       = Arrays::value($param, 'date');
        $fullDate = $yearmonth . '-' . $date;
        if(!$yearmonth || !$date || !Datetime::isDate($fullDate)){
            return [];
        }

        $con[] = ['full_date','=',$fullDate];
        $con[] = ['time_key','=',$timeKey];
        $info = self::where($con)->find();
        if(!$info){
            $info['full_date']  = $fullDate;
            $info['time_key']   = $timeKey;
            // 20230527:控制前端显示
            $info['status']     = 1;
        }
        return $info;
    }
    
    /**
     * 每日信息保存
     * @param type $timeKey     类型
     * @param type $date        日期
     * @param type $describe    描述
     */
    public static function dailySave($timeKey, $date, $describe){
        if(!$date){
            throw new Exception('归属日期必须');
        }
        $dateN = date('Y-m-d',strtotime($date));
        $con[] = ['full_date','=',$dateN];
        $con[] = ['time_key','=',$timeKey];
        $id = self::where($con)->value('id');

        $data['id']         = $id ? : self::mainModel()->newId();
        $data['time_key']   = $timeKey;
        $data['full_date']  = $dateN;
        $data['describe']   = $describe;

        return self::saveGetId($data);
    }
}
