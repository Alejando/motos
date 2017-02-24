<section class="news_home ">
	
		<div class="ktm_container">
			<h3 class="ktm_white ">NOTICIAS RECIENTES</h3>
		</div>
		<div class="news_div">
		@for($i=1;$i<=4;$i++)
			<div class=" news_content"> 
				<figure class="news_img">
					<img src="img/news/news{{ $i }}.jpg">
				</figure>
				<a href=""><div class="content_text">
					<div class="label_content">
						<figure class="label_img">
							<img src="img/svg/etiqueta.svg">				
						</figure>
						<p class="label_text">TRAVEL</p>
					</div>
					<div class="news_text">
						<h5 class="ktm_white_light">01 DE NOVIEMBRE</h5>
						<h3 class="ktm_white">Edicíón XVII de la copa Freestyle Motorbikes</h3>
					</div>
				</div></a>
			</div>
		@endfor
	</div>
</section>