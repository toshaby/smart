<?php

namespace App\Services;

use App\Enums\StatusEnum;
use App\Http\Resources\CreateTicketResource;
use App\Models\Customer;

class WidgetService
{

    public function store($data)
    {
        $phone = $data['phone'] ? preg_replace('/[\\(\\) \\-]/', '', $data['phone']) : '';
        $email = $data['email'];
        $arCustomerFind = $arCustomerUpdate = [];

        if ($phone) {
            $arCustomerFind['phone'] = $phone;
            if ($email) $arCustomerUpdate['email'] = $email;
        } else {
            $arCustomerFind['email'] = $email;
        };
        $arCustomerUpdate['name'] = $data['name'];
        $customer = Customer::updateOrCreate($arCustomerFind, $arCustomerUpdate);

        $ticket = $customer->tickets()->create([
            'theme' => $data['theme'],
            'text' => $data['text'],
            'status' => StatusEnum::new
        ]);


        if (isset($data['files'])) {
            foreach ($data['files'] as $file)
                $ticket->addMedia($file)->toMediaCollection();
        }

        return new CreateTicketResource($ticket);
    }
}
