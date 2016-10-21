<?php
namespace DwSetpoint\Http\Controllers;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use DwSetpoint\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;


/**
 * Description of ProductCtrl
 *
 * @author jdiaz
 */
class ProductCtrl extends Controller{
    
   
    
    public function findChildrenBySlug($parent, $categorySlug) {
        $query = \DwSetpoint\Models\Category::where('name', 'like',  ucwords(str_replace('-', " ", $categorySlug)));
        if($parent!==null){
            $query->where('parent_category_id','=', $parent->id);
        }
        $category = $query->get();
        if($category->count()) {
            return $category->get(0);
        } 
        return null;
    }
    public function showCategory($slug, $page = 1) {        
        $expoSlug = explode("/", $slug);
        $category = null;
        $currentPage = $page;
        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });
        foreach($expoSlug as $categoryslug) {
            $r = $this->findChildrenBySlug($category,$categoryslug);
            if($r === null) {
                abort(404);
            }
            $category = $r;
        }
        if($category) {
//            return $category->getPath();
            return $category->products()->paginate();
        }
        abort(404);
    }
    public function showProduct($slugs){
        dd($slugs);
    }
}