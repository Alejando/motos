<?php

namespace GlimGlam\Console\Commands;

use Illuminate\Console\Command;

class GGFinishedAuction extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gg:finished {code} {duration}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return mixed
     */
    public function handle() {
        $code = $this->argument("code");
        $duration = $this->argument("duration");
        $now = new \DateTime();
        $end = clone $now;
        $end->add(new \DateInterval($duration));
        $auction = \GlimGlam\Models\Auction::getByCode($code);
        $auction->end_date = $end->format('Y-m-d H:i:s');
        $auction->save();
    }
}
