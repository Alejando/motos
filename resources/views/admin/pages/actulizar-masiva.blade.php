<div class="row content shadow">
    <div class="text-center">
        <table style="margin: 0 auto;">
            <tr>
                <td style="text-align: center ; padding-top: 35px;">
                    <img src="{{asset('img/icon-excel.png')}}" width="50"><br>
                    <button class="btn btn-primary" onclick="$('.input-file').click()">Subir Excel</button>
                </td>
                
            </tr>
            <tr>
                <td style="text-align: center; padding-left: 10px; padding-top: 35px; padding-bottom: 35px">
                    <img src="{{asset('img/icon-excel.png')}}"  width="50"><br>
                    <button class="btn btn-primary" onclick="window.open('{{asset('img/productos.xlsx')}}','_self')">Descargar Excel</button>
                </td>
            </tr>
        </table>
        <input type="file" class="input-file" style="display: none">
    </div>
</div>