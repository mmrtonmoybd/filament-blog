<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 *
 * @property int $id
 * @property string $name
 * @property int|null $parent_id
 * @property Carbon|null $updated_at
 * @property Carbon|null $created_at
 * @property Category|null $category
 * @property Collection|Category[] $categories
 */
class Category extends Model
{
    protected $table = 'categories';

    protected $casts = [
        'parent_id' => 'int',
    ];

    protected $fillable = [
        'name',
        'parent_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function categories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}
