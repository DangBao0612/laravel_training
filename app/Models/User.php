<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder; // Global Scope
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str; // dùng cho chuỗi kiểm tra prefix
use Illuminate\Support\Facades\Hash; // Hash password (Mutator)

class User extends Authenticatable
{
    // CHẶN mass assignment cho is_admin
    protected $guarded = ['is_admin'];

    // hoặc:
    // protected $fillable = ['first_name', 'last_name', 'username', 'email', 'password'...]; cái này cho phép các cột được chỉ định đc Mass assignment, an toàn hơn, nhưng phải cập nhật thủ công từng cột được phép
    // // KHÔNG thêm 'is_admin' vào $fillable, đây là trường cần bảo vệ

    // @use HasFactory<\Database\Factories\UserFactory> 
    use HasFactory, Notifiable;


     // Mutator: khi gán $user->password = 'plain', tự động băm nếu giá trị CHƯA được mã hoá.
        public function setPassword($value): void
    {
        // nếu chuỗi đã là bcrypt (bắt đầu bằng $2y$) thì giữ nguyên
        $this->attributes['password'] = Str::startsWith($value, '$2y$')
            ? $value
            : Hash::make($value);
    }


    // Accessor: $user->full_name. Trả về First Last
        public function getFullNameAttribute(): string
    {
        return trim("{$this->first_name} {$this->last_name}");
    }

    // Local scope: User::admins(). Trả về các user có is_admin = 1

        public function scopeAdmins($query)
    {
        return $query->where('is_admin', 1);
    }

        protected static function booted(): void
    {
        static::addGlobalScope('active', function (Builder $q) {
            $q->where('is_active', 1);
        });
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function tasks()
    {
        return $this->hasMany(Task::class); // 1 user -> many tasks
    }

}
