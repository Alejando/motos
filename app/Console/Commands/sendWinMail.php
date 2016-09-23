<?php

namespace GlimGlam\Console\Commands;

use Illuminate\Console\Command;

class sendWinMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gg:reset {code} {start} {duration}';

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
    public function handle(){
        $code = $this->argument("code");
        $start = $this->argument("start");
        $duration = $this->argument("duration");
        if($start) {
            $now = new \DateTime();
            $now->add(new \DateInterval($start));
            $end = clone $now;
            $end->add(new \DateInterval($duration));
        }
        $auction = \GlimGlam\Models\Auction::getByCode($code);
        $auction->status = \GlimGlam\Models\Auction::STATUS_STAND_BY;
        $auction->sold_for = 0;
        $auction->last_offer = 0;
        $auction->winnername ="";
        $auction->num_bids = 0;
        $auction->start_date = $now->format('Y-m-d H:i:s');
        $auction->end_date = $end->format('Y-m-d H:i:s');
        $auction->save();
        
        
        $enrollments=\GlimGlam\Models\Enrollment::getEnrollments(false, $auction->id,true);
        $enrollments->update([
            'last_bid_date' => '0000-00-00 00:00:00',
            'chekin_room' =>  '0000-00-00 00:00:00',
            'last_fault_date_aux' =>  '0000-00-00 00:00:00',
            'next_penalty' =>  '0000-00-00 00:00:00',
            'faults' => 0,
            'unqualified' => 0,
            'totalbids' => 0,
            'bids' => 0
        ]);
        \GlimGlam\Models\Bid::where('auction','=',$auction->id)->delete();
//        dd($arguments = $this->argument());
    }
}
