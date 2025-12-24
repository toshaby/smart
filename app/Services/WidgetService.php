<?php

namespace App\Services;

use App\Enums\StatusEnum;
use App\Http\Resources\CreateTicketResource;
use App\Models\Customer;
use Carbon\Carbon;

class WidgetService
{

    public function store($data)
    {
        $phone = !empty($data['phone']) ? preg_replace('/[\\(\\) \\-]/', '', $data['phone']) : '';
        $email = !empty($data['email']) ? $data['email'] : '';
        $arCustomerFind = $arCustomerUpdate = [];

        if ($phone) {
            $arCustomerFind['phone'] = $phone;
            if ($email) $arCustomerUpdate['email'] = $email;
        } else {
            $arCustomerFind['email'] = $email;
        };
        $arCustomerUpdate['name'] = $data['name'];
        $customer = Customer::updateOrCreate($arCustomerFind, $arCustomerUpdate);

        //Ограничение на отправку для одного клиента, не более раз в сутки
        if ($customer->tickets()->where('created_at', '>=', Carbon::now()->subDay()->format('Y-m-d H:i:s'))->first()) {
            $errors = [];
            foreach ($arCustomerFind as $key => $value) {
                $errors[$key] = match ($key) {
                    'phone' => ["Номер $value уже использовался за текущие сутки"],
                    'email' => ["Email $value уже использовался за текущие сутки"]
                };
            };
            return ['errors' => $errors];
        }

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
