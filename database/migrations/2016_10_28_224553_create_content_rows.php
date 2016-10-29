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
        $content->title = 'Nosotros';
        $content->name = 'nosotros';
        $content->slug = 'nosotros';
        $content->content ='';
        $content->save();

        $content = new DwSetpoint\Models\Content;
        $content->title = 'Formas de pago';
        $content->name = 'formas-de-pago';
        $content->slug = 'formas-de-pago';
        $content->content ='';
        $content->save();

        $content = new DwSetpoint\Models\Content;
        $content->title = 'Ventajas';
        $content->name = 'ventajas';
        $content->slug = 'ventajas';
        $content->content ='';
        $content->save();

        $content = new DwSetpoint\Models\Content;
        $content->title = 'Terminos y condiciones';
        $content->name = 'terminos-y-condiciones';
        $content->slug = 'terminos-y-condiciones';
        $content->content ='';
        $content->save();

        $content = new DwSetpoint\Models\Content;
        $content->title = 'Condiciones de envío';
        $content->name = 'condiciones-de-envio';
        $content->slug = 'condiciones-de-envio';
        $content->content ='';
        $content->save();

        $content = new DwSetpoint\Models\Content;
        $content->title = 'Condiciones de retorno';
        $content->name = 'condiciones-de-retorno';
        $content->slug = 'condiciones-de-retorno';
        $content->content ='';
        $content->save();

        $content = new DwSetpoint\Models\Content;
        $content->title = 'Proctección de datos';
        $content->name = 'protecion-de-datos';
        $content->slug = 'protecion-de-datos';
        $content->content ='';
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
