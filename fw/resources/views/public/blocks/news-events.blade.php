{{-- Inicia  Categorias  --}}
<div class="category_news news_col_3">
    <div>
        <div>
            <hr class="line_title">
            <h3>Eventos</h3>
        </div>
        @foreach(DwSetpoint\Models\Post::orderBy('id','desc')->where('post_category_id',3)->take(3)->get() as $key=>$post)
            <div class="category_news_content">
                <div class="category_news_img">
                    <figure>
                        <img src="{{asset('img/news/news'.($key+1).'.jpg')}}">
                    </figure>
                </div>
                <div class="category_news_text">
                    <a href="{{route('details-news',$post->id)}}" class="link_white">
                        <h3 class="ktm_white">{{$post->title}}</h3>
                        <h5 class="ktm_white_light">{{$post->created_at}}</h5>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
{{-- Termina  Categorias  --}}
