@extends('public.base')
@section('body')
    @include('public.blocks.main-title')

    <section class="news ">
    	<div class="label_category ">
    		@include('public.blocks.categories-post')
    	</div>

        {{-- Inicia Noticias Populares --}}
        <div class="popular_news news_col_1">
            @foreach(DwSetpoint\Models\Post::orderBy('id','desc')->where('post_category_id',1)->take(3)->get() as $key=>$post)
                <div class="popular_content news_element{{ $key+1 }}">
                    <div  class="popular_img">
                        <figure>
                            <img src="{{asset('img/news/news'.($key+1).'.jpg')}}">
                        </figure>
                    </div>
                    <div  class="popular_text">
                        <a href="{{route('details-news',$post->id)}}" class="link_white">
                            <h5 class="ktm_orange">{{$post->category->name}}</h5>
                            <h4  class="ktm_black">{{$post->title}}</h4>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        {{-- Termina Noticias Populares --}}
        @include('public.blocks.news-favorite')
        {{-- Inicia Noticias Recientes --}}
        <div class="breaking_news news_col_2">
            <div>
                <hr class="line_title">
                <h3>NOTICIAS RECIENTES</h3>
            </div>
               @foreach(DwSetpoint\Models\Post::orderBy('id','desc')->take(3)->get() as $key=>$post)
                <div class="breaking_content">
                    <div class="breaking_title">
                        <h3 class="ktm_orange">{{$post->title}}</h3>
                    </div>

                    <div class="breaking_info">
                        <p class="ktm_banner_orange">{{$post->category->name}}</p>
                        <p class="ktm_gray_middle"> | </p>
                        <p class="ktm_black"> POR: <u>KTM MOTOS</u></p>
                        <p class="ktm_gray_middle"> {{$post->created_at}}</p>
                        <p class="ktm_gray_middle"> | </p>
                        <p class="ktm_gray_middle"><span class="fa fa-comments"></span> 3 </p>
                        <p class="ktm_gray_middle"><span class="fa fa-share-alt"></span> 12 </p>
                    </div>
                    <div class="breaking_img">
                         <figure>
                            <img src="img/news/news{{ $key+1 }}.jpg">
                        </figure>
                    </div>
                    <div class="breaking_text">
                        <p>
                          {{$post->body}}
                        <a href="{{route('details-news',$post->id)}}" class="link_orange">Continuar leyendo...</a>
                    </div>
                </div>
            @endforeach
        </div>
        {{-- Termina Noticias Recientes --}}
        <div class="news_col_3">
            {{--  Inicia SObre KTM --}}
            <div class="about_ktm ">
                <div>
                    <hr class="line_title">
                    <h3>SOBRE KTM MOTOS</h3>
                </div>
                <div class="about_ktm_content ktm_center">
                     <figure>
                         <img src="img/logo-naranja-negro-ktm-gdl.svg" alt="">
                     </figure>
                     <p>
                         Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque vulputate ligula dui, ac porta nunc elementum eu. Fusce in vulputate nulla. Donec ut felis tempor, tempor leo eu, vestibulum enim. Maecenas nisi felis, vehicula ultrices fringilla eget, dapibus in dui. Integer eu ultrices sapien. Nam molestie libero nibh, sit amet dictum ex ornare ut. Cras tempor varius rhoncus. In porta nec enim at efficitur.
                     </p>
                     <a href ="{{url('nosotros')}}" class="link_orange">leer más...</a>
                </div>
            </div>
             {{--  Termina SObre KTM --}}
             @include('public.blocks.newsletter')
        </div>
        @include('public.blocks.news-events')

    </section>

 @stop
