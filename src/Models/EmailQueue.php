<?php
/**
 * Created by PhpStorm.
 * User: chenyu
 * Date: 2020-05-24
 * Time: 10:24
 */

namespace JoseChan\Email\DataSet\Models;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EmailQueue
 * @package JoseChan\Email\DataSet\Models
 * @property int $id
 * @property int $mission_id
 * @property string $to_email
 * @property int $status
 * @property string $err_msg
 * @property EmailMission $mission
 */
class EmailQueue extends Model
{

    const STATUS_PENDING = 0;

    protected $fillable = ["to_email", "status", "err_msg"];

    public function mission()
    {
        return $this->belongsTo(EmailMission::class, "mission_id", "id");
    }

    /**
     * 创建多个对象
     * @param $list
     * @return array<self>
     */
    public static function buildMany(array $list)
    {
        $result = [];
        foreach ($list as $item) {
            $result[] = new static($item);
        }

        return $result;
    }

    /**
     * @param array $email_list
     * @param bool $is_obj
     * @return array
     */
    public static function buildManyByEmailList($email_list = [], $is_obj = true)
    {
        $list = [];
        foreach ($email_list as $email) {
            $list[] = [
                "to_email" => $email,
                "status" => self::STATUS_PENDING,
                "err_msg" => "",
            ];
        }

        return $is_obj ? self::buildMany($list) : $list;
    }

    /**
     * @param $where
     * @return int
     */
    public static function countQueueByMission($where)
    {
        return self::query()
            ->leftJoin('email_missions', 'email_missions.id', '=', 'email_queues.mission_id')
            ->where($where)
//            ->select(["email_queues.*", "email_missions.send_at"])
            ->count();
    }

    public static function fetchPendingList()
    {
        $start = Carbon::today();
        $end = Carbon::now();
        if ($start->format("Y-m-d H:i") === $end->format("Y-m-d H:i")) {
            $start->addMinute(-1);
        }

        return self::query()
            ->leftJoin('email_missions', 'email_missions.id', '=', 'email_queues.mission_id')
            ->where([
                ["email_missions.send_at", ">=", $start->format("Y-m-d H:i")],
                ["email_missions.send_at", "<=", $end->format("Y-m-d H:i")],
                ["status", "=", self::STATUS_PENDING]
            ])->get(["email_queues.*", "email_missions.send_at"]);
    }

}
