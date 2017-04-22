<?php

use Illuminate\Database\Migrations\Migration;

class CreateGuestbookTable extends Migration
{
    private $migrates;

    public function __construct()
    {
        $this->migrates = [
            new App\Services\Guestbook\Migration\CreateGuestbookTable(),
        ];
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach ($this->migrates as $migrate) {
            $migrate->up();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach ($this->migrates as $migrate) {
            $migrate->down();
        }
    }
}
