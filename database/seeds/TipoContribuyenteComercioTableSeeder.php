<?php

use Illuminate\Database\Seeder;
use App\TipoContribuyenteComercio;

class TipoContribuyenteComercioTableSeeder extends Seeder
{
     /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipoComerio = new TipoContribuyenteComercio();
        $tipoComerio->codigo = '4000101';
        $tipoComerio->denominacion = 'Construcción de Edificios para Vivienda Multifamiliar';
        $tipoComerio->descripcion = 'Construcción de Edificios para Vivienda Multifamiliar';
        $tipoComerio->alicuota_anual = 1.25;
        $tipoComerio->minimo_tributable = 0.30;
        $tipoComerio->save();   

        $tipoComerio = new TipoContribuyenteComercio();
        $tipoComerio->codigo = '4000102';
        $tipoComerio->denominacion = 'Construcción de Casas para Viviendas Unifamiliares.';
        $tipoComerio->descripcion = 'Construcción de Casas para Viviendas Unifamiliares.';
        $tipoComerio->alicuota_anual = 1.25;
        $tipoComerio->minimo_tributable = 0.60;
        $tipoComerio->save();

        $tipoComerio = new TipoContribuyenteComercio();
        $tipoComerio->codigo = '4000103';
        $tipoComerio->denominacion = 'Construcción de Edificios de Propiedad Privada, Especiales para: Oficinas, Despachos Profesionales Libres y Locales Comerciales';
        $tipoComerio->descripcion = 'Construcción de Edificios de Propiedad Privada, Especiales para: Oficinas, Despachos Profesionales Libres y Locales Comerciales';
        $tipoComerio->alicuota_anual = 1.25;
        $tipoComerio->minimo_tributable = 0.60;
        $tipoComerio->save();   

        $tipoComerio = new TipoContribuyenteComercio();
        $tipoComerio->codigo = '4000104';
        $tipoComerio->denominacion = 'Construcción de Hospitales';
        $tipoComerio->descripcion = 'Construcción de Hospitales';
        $tipoComerio->alicuota_anual = 1.25;
        $tipoComerio->minimo_tributable = 0.30;
        $tipoComerio->save();   

        $tipoComerio = new TipoContribuyenteComercio();
        $tipoComerio->codigo = '4000105';
        $tipoComerio->denominacion = 'Construcción de Clínicas';
        $tipoComerio->descripcion = 'Construcción de Clínicas';
        $tipoComerio->alicuota_anual = 1.25;
        $tipoComerio->minimo_tributable = 0.30;
        $tipoComerio->save();   

        $tipoComerio = new TipoContribuyenteComercio();
        $tipoComerio->codigo = '4000106';
        $tipoComerio->denominacion = 'Construcción de Dispensarios y Medicaturas Rurales';
        $tipoComerio->descripcion = 'Construcción de Dispensarios y Medicaturas Rurales';
        $tipoComerio->alicuota_anual = 1.25;
        $tipoComerio->minimo_tributable = 0.30;
        $tipoComerio->save();   

        $tipoComerio = new TipoContribuyenteComercio();
        $tipoComerio->codigo = '4000107';
        $tipoComerio->denominacion = 'Construcción de Dispensarios y Medicaturas Rurales';
        $tipoComerio->descripcion = 'Construcción de Dispensarios y Medicaturas Rurales';
        $tipoComerio->alicuota_anual = 1.25;
        $tipoComerio->minimo_tributable = 0.30;
        $tipoComerio->save();   

        $tipoComerio = new TipoContribuyenteComercio();
        $tipoComerio->codigo = '4000108';
        $tipoComerio->denominacion = 'Construcción de Dispensarios y Medicaturas Rurales';
        $tipoComerio->descripcion = 'Construcción de Dispensarios y Medicaturas Rurales';
        $tipoComerio->alicuota_anual = 1.25;
        $tipoComerio->minimo_tributable = 0.30;
        $tipoComerio->save();   

        $tipoComerio = new TipoContribuyenteComercio();
        $tipoComerio->codigo = '4000109';
        $tipoComerio->denominacion = 'Construcción de Hoteles';
        $tipoComerio->descripcion = 'Construcción de Hoteles';
        $tipoComerio->alicuota_anual = 1.25;
        $tipoComerio->minimo_tributable = 0.30;
        $tipoComerio->save();   

        $tipoComerio = new TipoContribuyenteComercio();
        $tipoComerio->codigo = '4000110';
        $tipoComerio->denominacion = 'Construcción de Edificios para Recreación y Esparcimiento';
        $tipoComerio->descripcion = 'Construcción de Edificios para Recreación y Esparcimiento';
        $tipoComerio->alicuota_anual = 1.25;
        $tipoComerio->minimo_tributable = 0.30;
        $tipoComerio->save();   

        $tipoComerio = new TipoContribuyenteComercio();
        $tipoComerio->codigo = '4000111';
        $tipoComerio->denominacion = 'Construcción de Edificios para Industrias y Talleres Fabriles';
        $tipoComerio->descripcion = 'Construcción de Edificios para Industrias y Talleres Fabriles';
        $tipoComerio->alicuota_anual = 1.25;
        $tipoComerio->minimo_tributable = 0.30;
        $tipoComerio->save();   

        $tipoComerio = new TipoContribuyenteComercio();
        $tipoComerio->codigo = '4000112';
        $tipoComerio->denominacion = 'Instalaciones de Pilotes, Trabajos de Excavación, Cimentación, Rehabilitación  de Tierras para Construcciones.';
        $tipoComerio->descripcion = 'Instalaciones de Pilotes, Trabajos de Excavación, Cimentación, Rehabilitación  de Tierras para Construcciones.';
        $tipoComerio->alicuota_anual = 1.25;
        $tipoComerio->minimo_tributable = 0.30;
        $tipoComerio->save();   

        $tipoComerio = new TipoContribuyenteComercio();
        $tipoComerio->codigo = '4000113';
        $tipoComerio->denominacion = 'Albañilería en Construcción de Edificios';
        $tipoComerio->descripcion = 'Albañilería en Construcción de Edificios';
        $tipoComerio->alicuota_anual = 1.25;
        $tipoComerio->minimo_tributable = 0.30;
        $tipoComerio->save();   

        $tipoComerio = new TipoContribuyenteComercio();
        $tipoComerio->codigo = '4000114';
        $tipoComerio->denominacion = 'Instalación de Plomería';
        $tipoComerio->descripcion = 'Instalación de Plomería';
        $tipoComerio->alicuota_anual = 1.25;
        $tipoComerio->minimo_tributable = 0.30;
        $tipoComerio->save();   

        $tipoComerio = new TipoContribuyenteComercio();
        $tipoComerio->codigo = '4000115';
        $tipoComerio->denominacion = 'Instalaciones Eléctricas.';
        $tipoComerio->descripcion = 'Instalaciones Eléctricas.';
        $tipoComerio->alicuota_anual = 1.25;
        $tipoComerio->minimo_tributable = 0.30;
        $tipoComerio->save();   

        $tipoComerio = new TipoContribuyenteComercio();
        $tipoComerio->codigo = '4000116';
        $tipoComerio->denominacion = 'Instalaciones de  Ascensores';
        $tipoComerio->descripcion = 'Instalaciones de  Ascensores';
        $tipoComerio->alicuota_anual = 1.25;
        $tipoComerio->minimo_tributable = 0.30;
        $tipoComerio->save();   

        $tipoComerio = new TipoContribuyenteComercio();
        $tipoComerio->codigo = '4000117';
        $tipoComerio->denominacion = 'Instalación de Aire Acondicionado y Sistemas de Ventilación';
        $tipoComerio->descripcion = 'Instalación de Aire Acondicionado y Sistemas de Ventilación';
        $tipoComerio->alicuota_anual = 1.25;
        $tipoComerio->minimo_tributable = 0.30;
        $tipoComerio->save();   

        $tipoComerio = new TipoContribuyenteComercio();
        $tipoComerio->codigo = '4000118';
        $tipoComerio->denominacion = 'Pintura y Decoración de Edificios.';
        $tipoComerio->descripcion = 'Pintura y Decoración de Edificios.';
        $tipoComerio->alicuota_anual = 1.25;
        $tipoComerio->minimo_tributable = 0.30;
        $tipoComerio->save();   

        $tipoComerio = new TipoContribuyenteComercio();
        $tipoComerio->codigo = '4000119';
        $tipoComerio->denominacion = 'Obras de Derribo y Demolición de Edificios';
        $tipoComerio->descripcion = 'Obras de Derribo y Demolición de Edificios';
        $tipoComerio->alicuota_anual = 1.25;
        $tipoComerio->minimo_tributable = 0.30;
        $tipoComerio->save();   

        $tipoComerio = new TipoContribuyenteComercio();
        $tipoComerio->codigo = '4000120';
        $tipoComerio->denominacion = 'Obras de Construcción, Reforma, Reparación y Demolición de Edificios No Especificados Propiamente';
        $tipoComerio->descripcion = 'Obras de Construcción, Reforma, Reparación y Demolición de Edificios No Especificados Propiamente';
        $tipoComerio->alicuota_anual = 1.25;
        $tipoComerio->minimo_tributable = 0.30;
        $tipoComerio->save();   

        $tipoComerio = new TipoContribuyenteComercio();
        $tipoComerio->codigo = '4000121';
        $tipoComerio->denominacion = 'Construcción de Carreteras';
        $tipoComerio->descripcion = 'Construcción de Carreteras';
        $tipoComerio->alicuota_anual = 1.25;
        $tipoComerio->minimo_tributable = 0.30;
        $tipoComerio->save();   

        $tipoComerio = new TipoContribuyenteComercio();
        $tipoComerio->codigo = '4000122';
        $tipoComerio->denominacion = 'Construcción de Calles y Avenidas';
        $tipoComerio->descripcion = 'Construcción de Calles y Avenidas';
        $tipoComerio->alicuota_anual = 1.25;
        $tipoComerio->minimo_tributable = 0.30;
        $tipoComerio->save();

        $tipoComerio = new TipoContribuyenteComercio();
        $tipoComerio->codigo = '5200101';
        $tipoComerio->denominacion = 'Abastos, Supermercados y Automercados';
        $tipoComerio->descripcion = 'Abastos, Supermercados y Automercados';
        $tipoComerio->alicuota_anual = 0.65;
        $tipoComerio->minimo_tributable = 0.60;
        $tipoComerio->save();

        $tipoComerio = new TipoContribuyenteComercio();
        $tipoComerio->codigo = '5200102';
        $tipoComerio->denominacion = 'Detal de Frutas, Verduras y Hortalizas';
        $tipoComerio->descripcion = 'Detal de Frutas, Verduras y Hortalizas';
        $tipoComerio->alicuota_anual = 0.65;
        $tipoComerio->minimo_tributable = 0.12;
        $tipoComerio->save();

        $tipoComerio = new TipoContribuyenteComercio();
        $tipoComerio->codigo = '5200103';
        $tipoComerio->denominacion = 'Detal de Carnes, Aves de Corral y Postura de Aves';
        $tipoComerio->descripcion = 'Detal de Carnes, Aves de Corral y Postura de Aves';
        $tipoComerio->alicuota_anual = 0.50;
        $tipoComerio->minimo_tributable = 0.18;
        $tipoComerio->save();

        $tipoComerio = new TipoContribuyenteComercio();
        $tipoComerio->codigo = '5200104';
        $tipoComerio->denominacion = 'Detal de Pescados y Mariscos';
        $tipoComerio->descripcion = 'Detal de Pescados y Mariscos';
        $tipoComerio->alicuota_anual = 0.50;
        $tipoComerio->minimo_tributable = 0.12;
        $tipoComerio->save();

        $tipoComerio = new TipoContribuyenteComercio();
        $tipoComerio->codigo = '5200105';
        $tipoComerio->denominacion = 'Detal de Bebidas Alcohólicas en Envases Originales (Licorerías)';
        $tipoComerio->descripcion = 'Detal de Bebidas Alcohólicas en Envases Originales (Licorerías)';
        $tipoComerio->alicuota_anual = 0.90;
        $tipoComerio->minimo_tributable = 0.60;
        $tipoComerio->save();

        $tipoComerio = new TipoContribuyenteComercio();
        $tipoComerio->codigo = '5200106';
        $tipoComerio->denominacion = 'Detal de Bebidas No Alcohólicas No Envasadas';
        $tipoComerio->descripcion = 'Detal de Bebidas No Alcohólicas No Envasadas';
        $tipoComerio->alicuota_anual = 0.60;
        $tipoComerio->minimo_tributable = 0.12;
        $tipoComerio->save();

        $tipoComerio = new TipoContribuyenteComercio();
        $tipoComerio->codigo = '5200107';
        $tipoComerio->denominacion = 'Detal de Hielo';
        $tipoComerio->descripcion = 'Detal de Hielo';
        $tipoComerio->alicuota_anual = 0.80;
        $tipoComerio->minimo_tributable = 0.60;
        $tipoComerio->save();

        $tipoComerio = new TipoContribuyenteComercio();
        $tipoComerio->codigo = '5200109';
        $tipoComerio->denominacion = 'Detal de Alimentos para Animales';
        $tipoComerio->descripcion = 'Detal de Alimentos para Animales';
        $tipoComerio->alicuota_anual = 0.60;
        $tipoComerio->minimo_tributable = 0.60;
        $tipoComerio->save();

        $tipoComerio = new TipoContribuyenteComercio();
        $tipoComerio->codigo = '5200110';
        $tipoComerio->denominacion = 'Bodegas y Pulperías';
        $tipoComerio->descripcion = 'Bodegas y Pulperías';
        $tipoComerio->alicuota_anual = 0.40;
        $tipoComerio->minimo_tributable = 0.18;
        $tipoComerio->save();

        $tipoComerio = new TipoContribuyenteComercio();
        $tipoComerio->codigo = '5200201';
        $tipoComerio->denominacion = 'Farmacias, Boticas y Expendio de Medicina';
        $tipoComerio->descripcion = 'Farmacias, Boticas y Expendio de Medicina';
        $tipoComerio->alicuota_anual = 0.70;
        $tipoComerio->minimo_tributable = 0.18;
        $tipoComerio->save();

        $tipoComerio = new TipoContribuyenteComercio();
        $tipoComerio->codigo = '5200301';
        $tipoComerio->denominacion = 'Detal de Telas y Mercería';
        $tipoComerio->descripcion = 'Detal de Telas y Mercería';
        $tipoComerio->alicuota_anual = 0.60;
        $tipoComerio->minimo_tributable = 0.30;
        $tipoComerio->save();   

    }
}
