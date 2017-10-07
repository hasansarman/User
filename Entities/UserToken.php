<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\User\Entities\Sentinel\User;

class UserToken extends \App\Models\UserToken
{

    protected $table = 'user_tokens';
    protected $fillable = ['USER_ID', 'ACCESS_TOKEN'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
