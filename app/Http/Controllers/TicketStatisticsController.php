<?php

namespace App\Http\Controllers;

use App\Services\TicketStatisticsService;

class TicketStatisticsController extends Controller
{
    public function __construct(private TicketStatisticsService $service) {}

    public function __invoke()
    {
        return ($this->service)();
    }
}
