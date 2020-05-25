<?php
/**
 * Created by PhpStorm.
 * User: chenyu
 * Date: 2020-05-24
 * Time: 10:25
 */

namespace JoseChan\Email\DataSet\Models;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EmailMission
 * @package JoseChan\Email\DataSet\Models
 * @property integer $id
 * @property integer $template_id
 * @property string $subject
 * @property string $from_name
 * @property string $from_email
 * @property string $send_at
 * @property Collection $queue
 * @property EmailTemplate $template
 */
class EmailMission extends Model
{
    public function queues()
    {
        return $this->hasMany(EmailQueue::class, "mission_id", "id");
    }

    public function template()
    {
        return $this->belongsTo(EmailTemplate::class, 'template_id', "id");
    }
}
