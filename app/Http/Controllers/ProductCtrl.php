<?php
namespace DwSetpoint\Http\Controllers;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use DwSetpoint\Http\Requests;
use Illuminate\Http\Request;



/**
 * Description of ProductCtrl
 *
 * @author jdiaz
 */
class ProductCtrl extends Controller{
    public function showProduct($slugs){
        dd($slugs);
    }
}
