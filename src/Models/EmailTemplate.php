<?php
/**
 * Created by PhpStorm.
 * User: chenyu
 * Date: 2020-05-24
 * Time: 10:21
 */

namespace JoseChan\Email\DataSet\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * Class EmailTemplate
 * @package JoseChan\Email\DataSet\Models
 * @property int $id
 * @property string $view
 * @property string $name
 */
class EmailTemplate extends Model
{

    /**
     * 获取选项
     * @return array
     */
    public static function getSelector()
    {
        $selector = [];
        self::query()->get()->map(function (self $item) use (&$selector) {
            if (!isset($selector[$item->id])) {
                $selector[$item->id] = $item->name;
            }
        });

        return $selector;
    }
}
