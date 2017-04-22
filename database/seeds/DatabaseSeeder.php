<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Services\Guestbook\Model\Guestbook::create([
            'name' => 'Joe Doe',
            'phoneNumber' => '+421 905 123 456',
            'message' => 'Test message',
        ]);
    }
}
