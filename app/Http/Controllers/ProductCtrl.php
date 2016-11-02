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
    // <editor-fold defaultstate="collapsed" desc="showCategory">
    public function showCategory($slug, $page = 1) {
        $currentPage = $page;
        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });

        $category = \DwSetpoint\Models\Category::getBySlug($slug);
        if($category) {
            return view('public.pages.products-page', [
                'products' => $category->products()->paginate(),
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

}