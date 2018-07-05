<?php echo '<?php' ?>

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RentalManagerUtilitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Truncating tables');
        $this->truncatePropellerTables();

        // Utilities data
        $utilities = config('utilities_seeder.data');

        foreach ($utilities as $key => $data) {
            // create a new amenity
            $do = \{{ $utility }}::create($data);
        }
    }

    /**
     * Truncates all the propeller tables
     *
     * @return  void
     */
    public function truncatePropellerTables()
    {
        Schema::disableForeignKeyConstraints();
        \{{ $utility }}::truncate();
        Schema::enableForeignKeyConstraints();
    }

}