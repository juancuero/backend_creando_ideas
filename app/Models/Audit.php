<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Audit as AuditTrait;
use OwenIt\Auditing\Contracts\Audit as AuditContract;

/**
 * @property mixed auditable_table
 * @property mixed auditable_type
 * @property int id
 */
class Audit extends Model implements AuditContract
{
    use AuditTrait;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'old_values' => 'json',
        'new_values' => 'json',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'auditable_id',
        'auditable_type',
        'event',
        'ip_address',
        'new_values',
        'old_values',
        'tags',
        'url',
        'user_agent',
        'user_id',
        'user_type',
        'updated_at',
    ];
}
