<?php

declare(strict_types=1);

namespace App\Infrastructure\Models;

use App\Infrastructure\Models\Casts\Hashed;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

/**
 * @property string $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property Carbon|string $created_at
 * @property Carbon|string $updated_at
 */
final class User extends Authenticatable
{
    use HasApiTokens, HasFactory;

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var string
     */
    protected $keyType = 'string';

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'password' => Hashed::class,
    ];

    public function entity(): \App\Domain\Entities\User
    {
        return new \App\Domain\Entities\User(
            $this->id,
            $this->name,
            $this->email,
            $this->password,
        );
    }
}
