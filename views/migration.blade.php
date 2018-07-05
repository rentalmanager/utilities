<?php echo '<?php' ?>

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RentalManagerUtilitiesSetupTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // Create table for the property identifications
        Schema::create('{{ $utilities['tables']['utilities'] }}', function(Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->timestamps();
        });

        // Pivot table
        Schema::create('{{ $utilities['tables']['utility_nodes'] }}', function(Blueprint $table) {
            $table->unsignedInteger('{{ $utilities['foreign_keys']['utility'] }}');
            $table->unsignedInteger('node_id')->index();
            $table->string('node_type');

            $table->foreign('{{ $utilities['foreign_keys']['utility'] }}')->references('id')->on('{{ $utilities['tables']['utilities'] }}')->onDelete('cascade');
            $table->primary(['{{ $utilities['foreign_keys']['utility'] }}', 'node_id', 'node_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('{{ $utilities['tables']['utilities'] }}');
        Schema::dropIfExists('{{ $utilities['tables']['utility_nodes'] }}');
    }
}