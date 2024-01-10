<?php

namespace App\Models;

use App\Models\Traits\DefaultDatetimeFormat;
use App\Models\Traits\HasActive;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use PhpParser\Node\Expr\AssignOp\Mod;

class Section extends Model
{
    use HasActive,
        DefaultDatetimeFormat;

    /**
     * Bootstrap the model and its traits.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('order', 'DESC');
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_id',
        'is_active',
        'title',
        'description',
        'order',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'breadcrumb'
    ];

    /**
     * Получить хлебные крошки
     *
     * @return array
     */
    public function getBreadcrumbAttribute()
    {
        return array_reverse($this->makeBreadcrumb($this));
    }

    private function makeBreadcrumb(Model $model, bool $isCurrent = true): array
    {
        $result = [];

        if ($isCurrent) {
            $result[] = [
                'name' => $model->title,
            ];
        } else {
            $result[] = [
                'name' => $model->title,
                'link' => [
                    'name' => 'sections.detail',
                    'params' => [
                        'id' => $model->getKey(),
                    ]
                ],
            ];
        }

        if (!is_null($model->parent))
            $result = array_merge($result, $this->makeBreadcrumb($model->parent, false));

        return $result;
    }

    /**
     * Получить родителя
     *
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    /**
     * Получить всех потомков
     *
     * @return HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    /**
     * Получить всех потомков в виде дерева
     *
     * @return HasMany
     */
    public function tree(): HasMany
    {
        return $this->children()->with('tree');
    }

    /**
     * Получить все задачи
     *
     * @return HasMany
     */
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'section_id');
    }
}
