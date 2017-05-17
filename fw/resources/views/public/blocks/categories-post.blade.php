<ul class="ktm_container">
        <li>CATEGORIAS:</li>
  @foreach(DwSetpoint\Models\PostCategory::orderBy('name','asc')->get() as $category)
    <li><a href=""><h4 class="ktm_gray_middle">{{$category->name}}</h4></a></li>
  @endforeach
</ul>
