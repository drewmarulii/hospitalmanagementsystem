<?php

namespace App\Http\Livewire;
use LaravelViews\Views\TableView;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User;
use LaravelViews\Facades\Header;

class UsersTableView extends TableView
{
    protected $model = User::class;

    public function repository(): Builder
    {
        return User::query();
    }

    public function headers(): array
    {
        return [
            Header::title('ID')->sortBy('userid')->width('20%'),
            Header::title('Email')->width('100px'),
        ];
    }

    public function row($model)
    {
        return [
            $model->userid,
            $model->email,
        ];
    }
}
