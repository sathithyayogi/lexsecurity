<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Events\DeviceDiagnosticsEvent;
use App\Events\DeviceDiagnosticShow;
use App\Events\WebsocketDemoEvent;
class connStatusUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'conn:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This update the connection status every 4 minute';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        DB::table('devices')
              ->update(['connectionStatus' => 0]);
        broadcast(new WebsocketDemoEvent("test"));
    }
}
