<?php

namespace App\Observers\V1;

use Auth;
use Illuminate\Support\Facades\Schema;

class ActionByObserver
{
    public function creating($model)
    {
        if (Schema::hasColumn($model->getTable(), 'created_by')) {
            if (($user = Auth::user())) {
                $model->created_by = $user->id;
            }
        }

        if (Schema::hasColumn($model->getTable(), 'updated_by')) {
            if (($user = Auth::user())) {
                $model->updated_by = $user->id;
            }
        }
    }

    public function updating($model)
    {
        if (Schema::hasColumn($model->getTable(), 'updated_by')) {
            if (($user = Auth::user())) {
                $model->updated_by = $user->id;
            }
        }
    }

    public function deleting($model)
    {
        if (Schema::hasColumn($model->getTable(), 'deleted_by')) {
            if (($user = Auth::user())) {
                $model->deleted_by = $user->id;
            }
        }
    }
}
