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
?><ul class="menumain hidden-sm hidden-xs">
    @foreach($categories as $category)
        <?php $subs = $category->subcategories;?>
        @if($subs->count())
            <?php $width = $getWidthSubs($subs)?>
            <li>
                <a href="" class="transicion">{{strtoupper($category->name)}}</a>
                <div class="cajasubmenu" style="width:{{($width*$subs->count())+2}}em">
                    <div class="row lineaencabezado">                        
                        @foreach($subs as $sub)
                            @if($sub->subcategories->count())
                                <div style="width:{{$width}}em; float:left;">
                                    <h3><span>{{$sub->name}}</span> <i class="fa fa-angle-down" aria-hidden="true"></i></h3>
                                </div>
                            @else
                                <div style="width:{{$width}}em; float:left;">
                                    <h3><a href="{{$sub->getURL()}}">{{$sub->name}}</a></h3>
                                </div>
                            @endif                        
                        @endforeach
                    </div>
                    
                    <div class="row">
                        @foreach($subs as $sub)
                            @if($sub->subcategories->count())                                
                                <div style="width:{{$width}}em; float:left;">
                                    <ul>
                                        @foreach($sub->subcategories as $subc)
                                            <li><a href="{{$subc->getURL()}}">{{$subc->name}}</a></li> 
                                        @endforeach                                        
                                    </ul>
                                </div>
                            @endif                            
                        @endforeach                        
                    </div>
                </div>
            </li>
        @else
            <li><a href="{{$category->getURL()}}" class="transicion">{{strtoupper($category->name)}}</a></li>
        @endif
    @endforeach
    <!-- <li><a href="" class="transicion">DESCUENTOS</a></li> -->
</ul>