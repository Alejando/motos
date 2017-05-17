{{-- Inicia Noticias Destacadas --}}
<div class="outstanding_news news_col_1">
<div>
        <hr class="line_title">
        <h3>NOTICIAS DESTACADAS</h3>

    </div>
    @foreach(DwSetpoint\Models\Post::orderBy('id','asc')->where('favorite',1)->take(3)->get() as $key=>$post)
        <div class="outstanding_content news_element{{ $key+1 }}">
            <div class="outstanding_img">
                <figure>
                    <img src="{{asset('img/news/news'.($key+1).'.jpg')}}">
                </figure>
            </div>
            <div class="outstanding_text">
                <a href="{{route('details-news',$post->id)}}" class="link_white">
                    <p class="ktm_banner_orange">{{$post->category->name}}</p>
                    <h3 class="ktm_white">{{$post->title}}</h3>
                    <h5 class="ktm_white_light">{{$post->created_at}}</h5>
                </a>
            </div>
        </div>
    @endforeach
</div>
{{-- Termina  Noticias Destacadas --}}
