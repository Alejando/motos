<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentRows extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $content = new DwSetpoint\Models\Content;
        $content->title = 'Acerca de KTM';
        $content->name = 'acerca-de-ktm';
        $content->slug = 'acerca-de-ktm';
        $content->content ='';
        $content->save();

        $content = new DwSetpoint\Models\Content;
        $content->title = 'Filosofía';
        $content->name = 'filosofia';
        $content->slug = 'filosofia';
        $content->content ='';
        $content->save();

        $content = new DwSetpoint\Models\Content;
        $content->title = 'Visión';
        $content->name = 'vision';
        $content->slug = 'vision';
        $content->content ='<p><em><span style="font-size: 24pt;"><strong>Misi&oacute;n</strong></span></em></p>
<p><span style="font-size: 14pt;">Nuestra Misi&oacute;n es generar diversi&oacute;n, adrenalina, sonrisas, salud, bienestar y sobre todo un excelente servicio a nuestros clientes; a trav&eacute;s de la calidad e innovaci&oacute;n de nuestro capital humano</span></p>';
        $content->save();

        $content = new DwSetpoint\Models\Content;
        $content->title = 'compromisos';
        $content->name = 'compromisos';
        $content->slug = 'compromisos';
        $content->content ='';
        $content->save();

        $content = new DwSetpoint\Models\Content;
        $content->title = 'Aviso de privacidad';
        $content->name = 'aviso-de-privacidad';
        $content->slug = 'aviso-de-privacidad';
        $content->content = ''
        $content->save();

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DwSetpoint\Models\Content::where('slug', 'nosotros')->delete();
        DwSetpoint\Models\Content::where('slug', 'formas-de-pago')->delete();
        DwSetpoint\Models\Content::where('slug', 'ventajas')->delete();
        DwSetpoint\Models\Content::where('slug', 'terminos-y-condiciones')->delete();
        DwSetpoint\Models\Content::where('slug', 'condiciones-de-envio')->delete();
        DwSetpoint\Models\Content::where('slug', 'condiciones-de-retorno')->delete();
        DwSetpoint\Models\Content::where('slug', 'protecion-de-datos')->delete();
    }
}
