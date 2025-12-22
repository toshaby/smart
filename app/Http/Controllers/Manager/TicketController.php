<?php

namespace App\Http\Controllers\Manager;

use App\Enums\StatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Manager\FilterTicketRequest;
use App\Http\Requests\Manager\UpdateTicketRequest;
use App\Models\Ticket;
use App\Services\Manager\TicketService;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function __construct(private TicketService $service) {}

    public function index(FilterTicketRequest $request)
    {
        $filters = $request->validated();
        $tickets = $this->service->index($filters);

        $statuses = StatusEnum::cases();

        return view('manager.tickets.index', ['tickets' => $tickets, 'filters' => $filters, 'statuses' => $statuses]);
    }

    public function show(Ticket $ticket)
    {
        $statuses = StatusEnum::cases();
        return view('manager.tickets.show', ['ticket' => $ticket, 'statuses' => $statuses]);
    }

    public function update(Ticket $ticket, UpdateTicketRequest $request)
    {
        $data = $request->validated();

        $result = $this->service->update($ticket, $data);
        
        return $result;
    }
}
