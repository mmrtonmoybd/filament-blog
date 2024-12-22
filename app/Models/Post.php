<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\PostStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Post
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $content
 * @property int|null $category_id
 * @property bool $is_comment
 * @property bool $is_featured
 * @property string|null $seo_tags
 * @property string|null $seo_summery
 * @property string|null $thumbnail
 * @property string $status
 * @property int $admin_id
 * @property Carbon|null $updated_at
 * @property Carbon|null $created_at
 * @property Admin $admin
 * @property Category|null $category
 */
class Post extends Model
{
    protected $table = 'posts';

    protected $casts = [
        'category_id' => 'int',
        'is_comment' => 'bool',
        'is_featured' => 'bool',
        'admin_id' => 'int',
        'status' => PostStatus::class,
        'seo_tags' => 'array',
    ];

    protected $fillable = [
        'title',
        'content',
        'category_id',
        'seo_tags',
        'seo_summery',
        'thumbnail',
        'admin_id',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
