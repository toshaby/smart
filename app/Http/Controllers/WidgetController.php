<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketRequest;
use App\Services\WidgetService;
use Illuminate\Http\Request;

class WidgetController extends Controller
{
    public function __construct(private WidgetService $service) {}

    public function store(StoreTicketRequest $request)
    {
        $validated = $request->validated();

        return $this->service->store($validated);
    }
}
