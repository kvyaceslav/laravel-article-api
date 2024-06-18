<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;

trait Permission
{
    /**
     * @param Model $model
     * @return bool
     */
    public function check(Model $model): bool
    {
        return !($model->user_id !== auth()->id());
    }
}
