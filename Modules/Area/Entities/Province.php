<?php

namespace Modules\Area\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Cache;
//use Kyslik\ColumnSortable\Sortable;
//use Modules\Core\Casts\Date;
use Modules\Core\App\Models\BaseModel;
//use Modules\Core\Exceptions\ModelCannotBeDeletedException;

class Province extends BaseModel
{
//    use Sortable;

    protected $fillable = [
        'name'
    ];

    public $sortable = [
        'id', 'name', 'created_at'
    ];

//    protected $casts = [
//        'created_at' => Date::class
//    ];

    public static function clearAllCaches(): void
    {
        if (Cache::has('provinces')) {
            Cache::forget('provinces');
        }

        if (Cache::has('all_provinces')) {
            Cache::forget('all_provinces');
        }
    }

    public static function booted(): void
    {
//        static::deleting(function (Province $province) {
//            if ($province->cities()->exists()) {
//                throw new ModelCannotBeDeletedException('این استان دارای شهر است و قابل حذف نمی باشد.');
//            }
//        });

        static::created(function () {
            static::clearAllCaches();
        });
        static::updated(function () {
            static::clearAllCaches();
        });
        static::saved(function () {
            static::clearAllCaches();
        });
        static::deleted(function () {
            static::clearAllCaches();
        });
    }

    public static function getAllProvinces(): \Illuminate\Support\Collection
    {
        return Cache::rememberForever('provinces', function () {
            return Province::query()
                ->where('status', 1)
                ->pluck('name', 'id');
        });
    }

    public function cities(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(City::class);
    }
}
