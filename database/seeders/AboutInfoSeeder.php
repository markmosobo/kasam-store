<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AboutInfo;

class AboutInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AboutInfo::create([
            'address' => 'P.O. BOX 1253 KAKAMEGA 58100',
            'phone1' => '0706470670',
            'phone2' => '0706470670',
            'email' => 'kasamstore@gmail.com',
            'kra_pin' => 'AJ0511031765',
            'vat' => '0025798E'
        ]);
    }
}
