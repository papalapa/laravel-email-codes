<?php

namespace Papalapa\Laravel\EmailCodes\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Papalapa\Laravel\EmailCodes\Factories\EmailCodeFactory;
use Ramsey\Uuid\Uuid;

/**
 * @property string      $id
 * @property int         $serial
 * @property string      $email
 * @property string      $code
 * @property Carbon      $created_at
 * @property Carbon      $updated_at
 * @property Carbon|null $deleted_at
 *
 * @method static EmailCodeFactory factory(...$parameters)
 */
final class EmailCode extends Model
{
    use SoftDeletes, HasFactory;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $guarded = [];

    protected $hidden = [];

    protected $casts = [
        'serial' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function __construct(array $attributes = [])
    {
        $this->id = Uuid::uuid4()->toString();

        parent::__construct($attributes);
    }

    protected static function newFactory(): EmailCodeFactory
    {
        return new EmailCodeFactory();
    }

    public function isAliveAfter(int $seconds): bool
    {
        return $this->created_at->addSeconds($seconds)->isAfter(Carbon::now());
    }
}
