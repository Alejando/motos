<?php

namespace GlimGlam\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class ProcessController extends BaseController {
    public function index(){
        
    }
    // <editor-fold defaultstate="collapsed" desc="startAuctions">
    public function startAuctions(){
        return \GlimGlam\Models\Auction::startAuctions();
        return (new \DateTime)->format(DATE_ATOM);
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="closeAuctions">
    public function closeAuctions(){
        return \GlimGlam\Models\Auction::closeAuctions();
        return (new \DateTime)->format(DATE_ATOM);
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="checkFaults">
    public function checkFaults(){
        $auctions = \GlimGlam\Models\Auction::getStarted()->get();
        foreach($auctions as $auction){
            $enrollments = \GlimGlam\Models\Enrollment::getEnrollments(false, $auction->id, true);
            $enrollments = $enrollments->where('unqualified','!=',true)->get();
            foreach($enrollments as $enrollment){
                if(!$enrollment->unqualified && ($enrollment->totalbids < $auction->bids)){
                    $hasOffers = false;
                    if($enrollment->last_fault_date_aux != "0000-00-00 00:00:00"){
                        $last_bid = new \DateTime($enrollment->last_fault_date_aux);
                        $hasOffers = true;
                    }else{
                        $last_bid = new \DateTime($auction->start_date);
                    }
                    $actualDate = new \DateTime();
                    
                    $diff = date_diff($actualDate, $last_bid);
                    $hours = $diff->format('%h');
                    $minutes = $diff->format('%i');
                    $diffMin = $hours*60+$minutes;
                    //Si no hay ofertas hechas por el usuario se resta por cada minuto
                    if($hasOffers){
                        //Se dividen los minutos entre lo especificado de tiempo max
                        $faults = floor($diffMin/$auction->max_user_quiet);
                    }else{
                        //Se resta 1 por cada minuto que ha pasado
                        $faults = floor($diffMin);
                    }
                    //Si ya tiene ofertas
                    if($hasOffers){
                        if($actualDate > new \DateTime($enrollment->next_penalty)){
                            $next_penalty = clone $actualDate;
                            $next_penalty->add(new \DateInterval('PT'.$auction->max_user_quiet.'M'));
                            $enrollment->next_penalty = $next_penalty;
                        }
                    }
                    //Si las faltas son mayor a 0 y ha realizado ofertas
                    if($faults > 0 && $hasOffers){
                        //Se asigna como fecha de oferta para calculo futuro
                        $enrollment->last_fault_date_aux = $actualDate;
                        //Se aumenta las faltas que lleve el usuario
                        $enrollment->faults = $enrollment->faults + $faults;
                        $enrollment->totalbids++;
                    }else if($faults > 0){//Si no ha realizado ofertas y las faltas son mas de 0
                        $enrollment->faults = $faults;
                    }
                    if( !($enrollment->faults <= ($auction->bids - $auction->min_bids) ) ){
                        $enrollment->unqualified = true;
                    }
                    $enrollment->save();
                }else{
                    //echo json_encode(['result'=>'unqualified']);
                }
            }
        }
    }
    // </editor-fold>
}
