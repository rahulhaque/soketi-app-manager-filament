<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('key', 100);
            $table->string('secret', 100);
            $table->integer('max_connections')->default(-1);
            $table->boolean('enable_client_messages')->default(false);
            $table->boolean('enabled')->default(true);
            $table->integer('max_backend_events_per_sec')->default(-1);
            $table->integer('max_client_events_per_sec')->default(-1);
            $table->integer('max_read_req_per_sec')->default(-1);
            $table->json('webhooks');
            $table->tinyInteger('max_presence_members_per_channel')->default(100);
            $table->tinyInteger('max_presence_member_size_in_kb')->default(10);
            $table->tinyInteger('max_channel_name_length')->default(100);
            $table->tinyInteger('max_event_channels_at_once')->default(100);
            $table->tinyInteger('max_event_name_length')->default(100);
            $table->tinyInteger('max_event_payload_in_kb')->default(100);
            $table->tinyInteger('max_event_batch_size')->default(10);
            $table->boolean('enable_user_authentication')->default(false);
            $table->ownerships();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
