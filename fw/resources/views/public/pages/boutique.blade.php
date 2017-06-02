@extends('public.base')
@section('body')
  @include('public.blocks.main-title')
  <section class="boutique">
    <div class="row">
      <div class="col-lg-3 col-md-3 col-sm-12 filters">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">CATEGORÍA</h3>
          </div>
          <div class="panel-body">
            <ul>
              <li><a href="#">TODAS</a></li>
              <li><a href="#">OFFROAD</a></li>
              <li><a href="#">STREET</a></li>
            </ul>
          </div>
        </div>
        <div class="catalog-downloads">
          <h3>Ver catálogos completos</h3>
            <a href="#" class="btn ">Ver catálogo Offroad</a>
            <a href="#" class="btn ">Ver catállogo Street</a>
        </div>
      </div>
      <div class="col-lg-9 col-md-9 col-sm-12 products">
      <div class="row">
        @include('public.blocks.pagination')
      </div>
      <div class="row">
      @foreach ($paginator as $product)
          @include('public.blocks.product-boutique')
      @endforeach
      </div>
      <div class="row">
        @include('public.blocks.pagination')
      </div>
      </div>
    </div>
  </section>
@stop
