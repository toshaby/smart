<?php

namespace Database\Factories;

use App\Enums\StatusEnum;
use App\Models\Customer;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Collection;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    private array|null $arCustomers = null;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        if (is_null($this->arCustomers)) {
            $this->arCustomers = [];
            foreach (Customer::all() as $customer) $this->arCustomers[] = $customer->id;
        };

        $timestamp = fake()->dateTimeBetween('-2 months');
        $date = $timestamp->format("Y-m-d H:i:s");

        return [
            'theme' => fake()->text(10),
            'text' => fake()->text(100),
            'status' => fake()->randomElement(StatusEnum::class),
            'customer_id' => fake()->randomElement($this->arCustomers),
            'created_at' => $date,
            'updated_at' => $date,
            'answered_at' => fake()->dateTimeBetween($timestamp)->format("Y-m-d H:i:s")
        ];
    }

    public function configure()
    {
        return $this->afterMaking(function (Ticket $ticket) {
            if ($ticket->status->value != StatusEnum::processed->value) {
                $ticket->answered_at = null;
            }
        })
            ->afterCreating(function (Ticket $ticket) {
                $path = resource_path('factory_images');
                $arFiles = array_values(array_filter(scandir($path), fn($item) => is_file($path . '/' . $item)));
                $count = rand(0, 3);
                $files = fake()->randomElements($arFiles, $count);
                foreach ($files as $file)
                    $ticket->addMedia($path . "/" . $file)->preservingOriginal()->toMediaCollection();
            });
    }
}
