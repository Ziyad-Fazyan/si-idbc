<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class DeletePresensiImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'presensi:delete-images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete all photos in public/storage/images/presensi directory';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $directory = public_path('storage/images/presensi');

        if (!File::exists($directory)) {
            $this->error("Directory does not exist: {$directory}");
            return 1;
        }

        $files = File::files($directory);

        foreach ($files as $file) {
            File::delete($file);
        }

        $this->info('All photos in presensi directory have been deleted.');

        return 0;
    }
}
