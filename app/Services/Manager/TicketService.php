<?php

namespace App\Services\Manager;

use App\Enums\StatusEnum;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class TicketService
{
    public function index(array $filters)
    {

        $tickets = Ticket::with('customer');

        if (isset($filters['phone'])) $tickets->whereHas('customer', function (Builder $query) use ($filters) {
            $query->where('phone', preg_replace('/[\\(\\) \\-]/', '', $filters['phone']));
        });
        if (isset($filters['email'])) $tickets->whereHas('customer', function (Builder $query) use ($filters) {
            $query->where('email', $filters['email']);
        });
        if (isset($filters['status'])) $tickets->where('status', $filters['status']);
        if (isset($filters['datefrom'])) $tickets->where('created_at', '>=', $filters['datefrom']);
        if (isset($filters['dateto'])) $tickets->where('created_at', '<=', $filters['dateto']);

        $tickets = $tickets->paginate(10)->withQueryString();
        $tickets->map(function ($ticket) {
            $ticket->text = Str::limit($ticket->text, 20, preserveWords: true);
        });

        return $tickets;
    }

    public function update(Ticket $ticket, array $data)
    {
        $ticket->update([
            'status' => $data['status'],
            'answered_at' => ($data['status'] == StatusEnum::processed->value) ? date('Y-m-d H:i:s') : null,
        ]);
        return ['success' => true];
    }
}
