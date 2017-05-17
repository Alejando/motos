
<section class="news_home ">

		<div class="ktm_container">
			<h3 class="ktm_white ">NOTICIAS RECIENTES</h3>
		</div>
		<div class="news_div">
		@foreach(DwSetpoint\Models\Post::orderBy('id','desc')->take(4)->get() as $key=>$post)

			<div class=" news_content">
				<figure class="news_img">
					<img src="img/news/news{{ $key+1 }}.jpg">
				</figure>
				<a href="{{route('details-news',$post->id)}}"><div class="content_text">
					<div class="label_content">
						<figure class="label_img">
							<img src="img/svg/etiqueta.svg">
						</figure>
						<p class="label_text">{{$post->category->name}}</p>
					</div>
					<div class="news_text">
						<h5 class="ktm_white_light">{{$post->created_at}}</h5>
						<h3 class="ktm_white">{{$post->title}}</h3>
					</div>
				</div></a>
			</div>
		@endforeach
	</div>
</section>
