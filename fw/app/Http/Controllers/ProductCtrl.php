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
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Input;

/**
 * Description of ProductCtrl
 *••••••
 * @author jdiaz
 */
class ProductCtrl extends Controller{
    // <editor-fold defaultstate="collapsed" desc="showCategory">
    public function showCategory($slug, $page = 1) {
        $page = Input::get('paginate'); //Pendiente a revision
//        $currentPage = $page;
//        Paginator::currentPageResolver(function () use ($page) {
//            return $page;
//        });

        $category = \DwSetpoint\Models\Category::getBySlug($slug);
       
        /* @var $paginator \Illuminate\Pagination\LengthAwarePaginator */
//        echo dd($category->hasSubcategories());

        if($category->hasSubcategories()){
            $paginator = $category->getRecursiveProducts(true)->paginate(12);
        } else {
            $paginator = $category->products()->paginate(12);
        }
        $paginator->setPageName("no");
//        return $paginator;
        if($category) {
            return view('public.pages.products-page', [
                'products' => $paginator,
                'categorySlug' => $slug,
                'caregory' => $category
            ]);
        }
        abort(404);
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="showDetails">
    public function showDetails($categorySlug, $productSlug) {
        $category = \DwSetpoint\Models\Category::getBySlug($categorySlug);
        $product = \DwSetpoint\Models\Product::getBySlug($productSlug);
        $parents = [];
        \DwSetpoint\Models\Category::getParents($category, $parents);
        if($product) {
            return view('public.pages.detail', [
                'showOffert'=> false,
                'showBannerBottom' => false,
                'product' => $product,
                'category' => $category,
                'parents' => $parents,
                'categoryURL' => route('product.getCategoryPage',[
                    'slugs' => $categorySlug,
                    'page' => 1
                ])
            ]);
        }
        abort(404);
    }
    // </editor-fold>

    public function renameImg($path, $previousName, $newName) {

    }

    public function removeImg($path) {

    }

    public function getSearch(Request $request, $page = 1) {
        $search = $request->input('search');
        $paginator = \DwSetpoint\Models\Product::where('name', 'like', '%'.$search.'%')->paginate(4);

        if($paginator) {
            return view('public.pages.products-search', [
                'products' => $paginator
            ]);
        }
        abort(404);
    }

    public function cacharAlgo(Request $request){
        // return "tumama";
        return $request->input('search');
    }

}