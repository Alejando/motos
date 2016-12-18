<?php
$categories = DwSetpoint\Models\Category::getRoots();
$getWidthSubs = function ($subs) {
    $toplength = 0;
    foreach ($subs as $subacategory){
        $lenghName = strlen($subacategory->name);
        if($lenghName>$toplength){
            $toplength = $lenghName;
        }
    }
    $toplength;
    return "$toplength";
}
?>
<div class="cajamenumovil hidden-md hidden-lg">
    <a class="btncatalogo transicion"><i class="fa fa-bars"></i> <span>CATEGORÍAS</span></a>
    <div class="menumainmovil">
        <div class="cajacerrar"><a class="btncerrar transicion"><i class="fa fa-close"></i></a></div>
        
        @foreach($categories as $category)
            <?php $subs = $category->subcategories;?>
        
            @if($subs->count())
                <a href="" data-btnsub="{{str_slug($category->name)}}" class="transicion">{{strtoupper($category->name)}}<i class="fa fa-angle-right pull-right"></i></a>
                <div data-mnusub="{{str_slug($category->name)}}" class="submenumovil">   
                    <div class="cajacerrar transicion"><a class="btncerrar"><i class="fa fa-close"></i></a></div>
                    @foreach($subs as $sub)
                        @if($sub->subcategories->count())
                            <h3><span>{{$sub->name}}</span> <i class="fa fa-angle-down" aria-hidden="true"></i></h3>
                            @foreach($sub->subcategories as $s)
                            <a href="{{$s->getURL()}}" class="transicion">{{$s->name}}</a>
                            @endforeach
                        @else
                            <h3><span>{{$sub->name}}</span> <i class="fa fa-angle-down" aria-hidden="true"></i></h3>
                        @endif
                    @endforeach
                </div>
            @else
                <a href="" data-btnsub="" class="transicion">{{strtoupper($category->name)}}</a>
            @endif
        @endforeach
    </div>
</div>