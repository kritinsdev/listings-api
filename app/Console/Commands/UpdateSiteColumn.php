<?php

namespace App\Console\Commands;

use App\Models\Listing;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateSiteColumn extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-site-column';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Will extract hostname from url column in listings table and update site column with hostname';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        DB::transaction(function () {
            $listings = Listing::all();

            foreach ($listings as $listing) {
                $urlComponents = parse_url($listing->url);
                $host = $urlComponents['host'];

                $site = explode('.', $host)[1];

                $listing->site = $site;
                $listing->save();
            }
        });
        
        $this->info('Site column updated successfully');

        return 0;
    }
}
