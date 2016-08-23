<?php

namespace GlimGlam\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class ProcessController extends BaseController {
    public function index(){
        
    }
    public function startAuctions(){
        return \GlimGlam\Models\Auction::startAuctions();
        return (new \DateTime)->format(DATE_ATOM);
    }
    public function closeAuctions(){
        return \GlimGlam\Models\Auction::closeAuctions();
        return (new \DateTime)->format(DATE_ATOM);
    }
    public function checkFaults(){
        $auctions = \GlimGlam\Models\Auction::getStarted()->get();
        foreach($auctions as $auction){
            $enrollments = \GlimGlam\Models\Enrollment::getEnrollments(false, $auction->id, true);
            $enrollments = $enrollments->where('unqualified','!=',true)->get();
            foreach($enrollments as $enrollment){
                $noOfers = false;
                if($enrollment->last_bid_date != "0000-00-00 00:00:00"){
                    $last_bid = new \DateTime($enrollment->last_bid_date);
                    $noOfers = true;
                }else{
                    $last_bid = new \DateTime($auction->start_date);
                }
                $actualDate = new \DateTime();
                
                $diff = date_diff($actualDate, $last_bid);
                $hours = $diff->format('%h');
                $minutes = $diff->format('%i');
                $diffMin = $hours*60+$minutes;
                $faults = floor($diffMin/$auction->max_user_quiet);
                
                if($faults <= ($auction->bids - $auction->min_offer) ){
                    if($noOfers){
                        $enrollment->faults = $faults;
                    }else{
                        $enrollment->faults = $enrollment->faults+$faults;
                    }
                }else{
                    $enrollment->unqualified = true;
                }
                $enrollment->save();
            }
        }
    }
}
