<section class="offerts">
    <div id="owl-offerts" class="owl-carousel owl-theme">
        @for($i=0;$i<3;$i++)
        <div class="item">
            <div class="producto">
                <div class="productohover">
                    <div class="productotable">
                        <div>
                            <!-- <a href="" ng-class="class" class="btnk" ng-click="addBookmark()"></a> -->
                            <h3>$000.00</h3>
                            <a href="" class="btnc"></a>
                        </div>
                    </div>
                </div>
                <div class="offert sprite globo-{{rand(1, 2)}}">%70</div>
                <img src="{{ asset('img/template/productoejemplo.jpg')}}" class="img-responsive" />
                <h3>Zapatos Verdes Bonitos</h3>
                <h2>$000.00</h2>
            </div>
        </div>
        @endfor
    </div>
    <div style="clear: both"></div>
    <div class="subtitle">
        LIFESTYLE
    </div>
</section>