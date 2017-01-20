@extends('public.base')
@section('headers')
    <script>
        var product = {{$product->id}};
        {!!$categoryURL ? 'var CATEGORYS_URL='.json_encode($categoryURL).';' : ''!!}
    </script>
@stop
@section('scripts')
<script type="text/javascript" src="{{asset('js/thirdparty/zoom/jquery.elevatezoom.js')}}"></script>
<script type="text/javascript" src="{{asset('js/config_zoom.js')}}"></script>
<!-- Facebook pixel code -->
        <script>
            !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
            n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
            document,'script','https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '488925211317397');
            fbq('track', "PageView");
        </script>
        <!-- Facebook pop up -->
        <script>
            window.fbAsyncInit = function() {
              FB.init({
                appId      : '1068590149917039',
                xfbml      : true,
                version    : 'v2.8'
              });
            };

            (function(d, s, id){
               var js, fjs = d.getElementsByTagName(s)[0];
               if (d.getElementById(id)) {return;}
               js = d.createElement(s); js.id = id;
               js.src = "//connect.facebook.net/en_US/sdk.js";
               fjs.parentNode.insertBefore(js, fjs);
             }(document, 'script', 'facebook-jssdk'));
        </script>

        <script type="text/javascript">
            $('.share-room.share-fb').on('click', function(e) {
                e.preventDefault();
                FB.ui({
                  method: 'share',
                  display: 'popup',
                  picture: '{{asset("productos/".$product->id."/cover")}}',
                  description: '{!!json_encode($product->description)!!}',
                  title: 'Tennis {!!$product->name!!}',
                  caption: 'Bounce:: Tennis Lifestyle',
                  href: window.document.URL,
                }, function(response){});
            });

        </script>
        <script>  
          $('.popupTw').click(function(event) {
            var width  = 500,
                height = 400,
                left   = ($(window).width()  - width)  / 2,
                top    = ($(window).height() - height) / 2,
                url    = this.href+'&url='+window.document.URL,
                opts   = 'status=1' +
                         ',width='  + width  +
                         ',height=' + height +  
                         ',top='    + top    +  
                         ',left='   + left;
            window.open(url, 'twitter', opts);
            return false;
          }); 
        </script>
@stop
@section('body')

<div ng-app="setpoint" ng-controller="ProductDetailsCtrl">
        <div class="breadcrumbcustom">
            @if($category)
                @foreach($parents as $parent)
                    {{ucwords($parent)}} <span class="separador">-</span>
                @endforeach
                <span class="current">{{$category->name}}</span>
            @endif
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="cajaimagen">
                    <img ng-src="@{{selectedImg ? product.getImg(selectedImg, 468, 438):''}}" class="img-responsive" />
                    <!-- <span class="zoom"></span> -->
                </div>
                <div class="margentop30">
                    <div>
                        <div class="item"  ng-repeat="item in selectedImgs" class="item" style="float: left;
                                width:95px;
                                height: 95px;">
                            <a class="btnvista"
                                ng-click="selectImg(item)"
                                style="
                                cursor: pointer;
                                background: url('@{{product ? product.getImg(item,100,100) : ''}}') center center;
                            "></a>
                        </div>
                        <div style="clear: both"></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="cajadetalle">
                    <img  src="{{ $product->brand->getImgURL(120,66) }}" class="pull-right" />
                    <h2 class="titulo">{{$product->name}}</h2>
                    <div class="serie">Num. Serie {{$product->code}}</div>
                    <div class="row margentop50">
                        <div class="col-sm-6">
                            <h3 class="precioazul">{{Helpers::formatCurrency($product->priceFrom-$product->getClculateDiscount())}}</h3>
                        </div>
                        @if($product->hasDiscount())
                            <div class="col-sm-6">
                                <h3 class="precioamarillo">
                                    {{Helpers::formatCurrency($product->priceFrom)}}
                                    <div class="globo pabsoluto"><span>{{$product->discountPercentage}}%</span></div>
                                </h3>
                            </div>
                        @endif
                    </div>
                    <div class="row margentop30">
                        <div class="col-xs-6">
                            <div class="cajacantidad">
                                <input type="text" name="cantidad" id="cantidad" value="1" />
                                <div class="botones">
                                    <a class="btnmenos">-</a>
                                    <a class="btnmas">+</a>
                                </div>
                            </div>
                            <div class="etiqueta">
                                <div><span>Cantidad</span></div>
                            </div>
                        </div>
                        @if($product->sizes->count())
                            <div class="col-xs-6">
                                <div class="etiqueta">
                                    <div>
                                        <span>
                                            <select name="talla" id="talla" ng-model="selectedSize" class="form-control stalla">
                                                <option></option>
                                                @foreach($product->sizes as $size)
                                                    <option value="{{$size->id}}">{{$size->name}}</option>
                                                @endforeach
                                            </select>
                                            Talla
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    @if($product->colors->count())
                        <div class="colores barraverde margentop30">
                            @foreach($product->colors as $color)
                            <span class=""
                                ng-click="selectColor({{$color->id}})"
                                ng-class="{'color-selected': selectedColor=={{$color->id}} }">
                                <span style="background-color: {{$color->rgb}};"></span>
                            </span>
                            @endforeach
                        </div>
                    @endif
                    <div class="row margentop30">
                        <div class="col-sm-4">
                            <a href="#" ng-click="addProduct($event)" class="btncarrito">
                                <div>
                                    <span>Agregar</span>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-8">
                            <div class="btnredes">
                                <a rel="canonical" href="http://twitter.com/share?text=Me%20Encantan%20&hashtags=BOUNCE,TennisLifestyle,Tennis" class="tw pull-right popupTw"></a>
                                
                                <a href="#"  class="fb pull-right share-room share-fb"></a>

                                <!--a href="" class="yt"></a-->
                                <!--a href="" class="in"></a-->
                            </div>
                        </div>
                    </div>
                    <div class="barraverde margentop30">
                        <a class="btndescripcion">Descripción</a>
                    </div>
                    <div class="text_newlines">{{$product->description}}</div>
                </div>
            </div>
        </div>
    </div>
    @include('public.blocks.randomProducts')
    @include('public.blocks.bannerBottom')
@stop

