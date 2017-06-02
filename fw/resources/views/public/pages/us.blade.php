@extends('public.base')
@section('body')
  @include('public.blocks.main-title')
  <div class="container_us">
    <div class="menu_us">
      <ul class="nav nav-tabs " role="tablist">
        <li role="presentation" class="active"><a href="#about-ktm" aria-controls="#about-ktm" role="tab" data-toggle="tab">Acerca de KTM</a></li>
        <li role="presentation"><a href="#philosophy" aria-controls="philosophy" role="tab" data-toggle="tab">Filosofía</a></li>
        <li role="presentation"><a href="#vision" aria-controls="vision" role="tab" data-toggle="tab">Visión</a></li>
        <li role="presentation"><a href="#commitments" aria-controls="commitments" role="tab" data-toggle="tab">Compromisos</a></li>
      </ul>
    </div>
    <div class="tab-content text_us">
      <div role="tabpanel" class="tab-pane active" id="#about-ktm">{!!DwSetpoint\Models\Content::getContetBySlug('acerca-de-ktm')->content!!}</div>
      <div role="tabpanel" class="tab-pane" id="philosophy">{!!DwSetpoint\Models\Content::getContetBySlug('filosofia')->content!!}</div>
      <div role="tabpanel" class="tab-pane" id="vision">{!!DwSetpoint\Models\Content::getContetBySlug('vision')->content!!}</div>
      <div role="tabpanel" class="tab-pane" id="commitments">{!!DwSetpoint\Models\Content::getContetBySlug('compromisos')->content!!}</div>
    </div>
  </div>
@stop
