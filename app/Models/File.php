<?php

namespace App\Models;

use App\Traits\HasCreatorAndUpdater;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Auth;

class File extends Model
{
    use HasFactory, NodeTrait, SoftDeletes, HasCreatorAndUpdater;

    public function isOwnedBy($userId): bool
    {
        return $this->created_by == $userId;
    }

    public function owner(): Attribute
    {
        return Attribute::make(
            get: function (mixed $value, array $attributes) {
                return $attributes['created_by'] == Auth::id() ? 'me' : $this->user->name;
            }
        );
    }

    public function get_file_size()
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $power = $this->size > 0 ? floor(log($this->size, 1024)) : 0;
        return number_format($this->size / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
    }
}
