<?php

namespace App\Models;

use App\Enums\StatusEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Ticket extends Model implements HasMedia
{
    use InteractsWithMedia, HasFactory;

    protected $guarded = [];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function statusName()
    {
        return StatusEnum::{$this->status}->getName();
    }

    #[Scope]
    protected function lastDay(Builder $query)
    {
        $query->where('created_at', '>=', Carbon::now()->subDay()->format('Y-m-d H:i:s'));
    }

    #[Scope]
    protected function lastWeek(Builder $query)
    {
        $query->where('created_at', '>=', Carbon::now()->subWeek()->format('Y-m-d H:i:s'));
    }

    #[Scope]
    protected function lastMonth(Builder $query)
    {
        $query->where('created_at', '>=', Carbon::now()->subMonth()->format('Y-m-d H:i:s'));
    }
}
