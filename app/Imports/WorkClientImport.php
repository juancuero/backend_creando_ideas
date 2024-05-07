<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithHeadingRow;

class WorkClientImport implements WithHeadingRow
{
    public function __construct()
    {
        $this->columns = [
            'CICLO',
            'CODIGO',
            'CICLO_2',
            'DPTO',
            'MPIO',
            'SECTOR',
            'RUTA_COMPLETA',
            'NOMBRE',
            'DIRECCION',
            'ESTADO',
            'MEDIDOR',
            'SERIE',
            'MEDIDA',
            'FACTOR',
            'DIGITOS',
            'ESTRATO',
            'TARIFA',
            'CARGA',
            'TIPO_ENERGIA',
            'TIPO_MEDICION',
            'PROMEDIO',
            'LECTURA',
            'TIPO_USO',
            'NODO',
            'ZONA',
            'LONGITUD',
            'LATITUD',
            'ALTITUD',
        ];
    }
}
