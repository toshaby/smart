<?php

namespace App\Services;

use App\Http\Resources\TicketStatisticsResource;
use App\Models\Ticket;

class TicketStatisticsService
{
    public function __invoke()
    {
        $data = [
            'day' => Ticket::lastDay()->count(),
            'week' => Ticket::lastWeek()->count(),
            'month' => Ticket::lastMonth()->count(),
        ];

        return new TicketStatisticsResource($data);
    }
}
