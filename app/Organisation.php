<?php

declare(strict_types=1);

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Organisation
 *
 * @property int         id
 * @property string      name
 * @property int         owner_user_id
 * @property Carbon      trial_end
 * @property bool        subscribed
 * @property Carbon      created_at
 * @property Carbon      updated_at
 * @property Carbon|null deleted_at
 *
 * @package App
 */
class Organisation extends Model
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'owner_user_id', 'trial_end', 'subscribed'
    ];

    /**
     * @var array
     */
    protected $dates = [
        'deleted_at'
    ];

    /**
     * @return BelongsTo
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, "owner_user_id", "id");
    }

    /**
     * @param $query
     * @param string $filter
     * @return mixed
     */
    public function scopeFilter($query, string $filter)
    {
        if($filter == "subbed"){
            return $query->where("subscribed", 1);
        }

        if($filter == "trial"){
            return $query->whereDate("trial_end", ">", Carbon::now()->toDateTimeString());
        }
    }
}
