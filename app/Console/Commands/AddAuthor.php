<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AddAuthor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // protected $signature = 'command:name';
    protected $signature = 'author:add {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    // protected $description = 'Command description';
    protected $description = 'Add a new author via API';
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
        $name = $this->argument('name');
        $token = Session::get('token');
        $response = Http::withToken($token)->post('https://candidate-testing.com/api/v2/authors', [
            'name' => $name,
        ]);

        if ($response->successful()) {
            $this->info('Author added successfully!');
        } else {
            $this->error('Failed to add author.');
        }
    }
}
