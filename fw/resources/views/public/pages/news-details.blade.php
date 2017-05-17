@extends('public.base')
@section('body')
    @include('public.blocks.main-title')

    <section class="news_details">
        <div class="label_category ">
            @include('public.blocks.categories-post')
        </div>

        {{-- Inicia Noticias Recientes --}}
        <div class="breaking_news news_col_2">


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
                            <img src="{{asset('img/news/news5.jpg')}}">
                        </figure>
                    </div>
                    <div class="breaking_text">
                        <p>
                          {{$post->body}}
                        </p>
                         <figure>
                            <img src="{{asset('img/news/news3.jpg')}}">
                        </figure>
                        <p>
                            {{$post->body}}
                        </p>

                    </div>
                </div>
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
                     <a href ="" class="link_orange">leer más...</a>
                </div>
            </div>
             {{--  Termina SObre KTM --}}
             @include('public.blocks.newsletter')
        </div>
        {{-- Inicia  Categorias  --}}
        @include('public.blocks.news-events')
    </section>

 @stop
