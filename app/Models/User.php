<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    // CHẶN mass assignment cho is_admin
    protected $guarded = ['is_admin'];

    // hoặc:
    // protected $fillable = ['first_name', 'last_name', 'username', 'email', 'password'...]; cái này cho phép các cột được chỉ định đc Mass assignment, an toàn hơn, nhưng phải cập nhật thủ công từng cột được phép
    // // KHÔNG thêm 'is_admin' vào $fillable, đây là trường cần bảo vệ

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
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

    public function tasks(){
        return $this->hasMany(Task::class); // 1 user -> many tasks
    }

    public function offices(){
        return $this->belongsToMany(Office::class) // n ∈ n
                ->withPivot('title') // Bảng trung gian (office_user) sẽ có thêm bảng title
                ->withTimestamps(); // Tự động quản lý 2 cột created_at và updated_at cho office_user
    }

}
