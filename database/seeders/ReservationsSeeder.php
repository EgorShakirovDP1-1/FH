<?php

namespace Database\Seeders;

use App\Models\Film;
use App\Models\User;
use App\Models\Reservation;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ReservationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $users = User::all()->count();
        $films = Film::all()->count();
        $reservations = $faker->numberBetween(50, 200);
        $addresses = ['Lidosta Rīga', 'Aspazijas bulvāris 32', 'Brīvības iela 366'];

        for ($i = 0; $i < $reservations; $i++) {
            $reservation = new Reservation();
            $reservation->user_id = $faker->numberBetween(1, $users);

            $film_id = $faker->numberBetween(1, $films);
            $reservation->film_id = $film_id;

            do {
                $start_date = $faker->dateTimeBetween('-1 month', '-1 week');
                $end_date = $faker->dateTimeBetween($start_date, '+1 week');
            } while (Reservation::where('film_id', $film_id)
                ->where(function($query) use ($start_date, $end_date) {
                    $query->whereBetween('start_date', [$start_date, $end_date])
                          ->orWhereBetween('end_date', [$start_date, $end_date]);
                })->exists());

            $reservation->start_date = $start_date;
            $reservation->end_date = $end_date;
            $reservation->start_time = $faker->time();

            if (rand(0, 1)) :
                $reservation->film_start_point = $faker->randomElement($addresses);
            else :
                $reservation->film_start_point = $faker->address;
            endif;

            if (rand(0, 1)) :
                $reservation->film_end_point = $faker->randomElement($addresses);
            else :
                $reservation->film_end_point = $faker->address;
            endif;

            $watch = $faker->numberBetween(200, 6000);
            $reservation->watch = $watch;

            $film = Film::find($film_id);
            $costPerDay = $film->ndc;
            $costPerwatch = $film->price_per_watch;
            $days = Carbon::parse($reservation->start_date)->diffInDays($reservation->end_date);
            $daysPrice = $days * $costPerDay;
            $watchPrice = $watch * $costPerwatch;
            $price = $daysPrice + $watchPrice;

            if (!in_array($reservation->film_start_point, $addresses)) {
                $price += 10;
            }

            if (!in_array($reservation->film_end_point, $addresses)) {
                $price += 10;
            }

            if ($price >= 1000) :
                $price *= 0.85;
            elseif ($price >= 500) :
                $price *= 0.9;
            elseif ($price >= 200) :
                $price *= 0.94;
            elseif ($price >= 100) :
                $price *= 0.97;
            endif;

            $reservation->end_price = $price;
            $reservation->save();
        }
    }
}
