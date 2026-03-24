<?php

namespace App\Helpers;

use App\Models\Document;

/**
 * Clase CodeGenerator
 * Genera el código único para un documento con el patrón: TIP_PREFIJO-PRO_PREFIJO-consecutivo.
 */
class CodeGenerator
{
    /**
     * Genera el código único para un nuevo documento.
     * 
     * @param string $tipPrefix Prefijo del tipo de documento.
     * @param string $proPrefix Prefijo del proceso.
     * @return string Código generado (ej: INS-ING-1).
     */
    public static function generate(string $tipPrefix, string $proPrefix): string
    {
        // El patrón que buscamos
        $pattern = "{$tipPrefix}-{$proPrefix}-";

        // Buscamos todos los documentos que tengan el mismo prefijo
        // Extraemos el consecutivo mayor
        $lastDocument = Document::where('DOC_CODIGO', 'LIKE', "{$pattern}%")
            ->orderByRaw('CAST(SUBSTRING_INDEX(DOC_CODIGO, "-", -1) AS UNSIGNED) DESC')
            ->first();

        if ($lastDocument) {
            // Extraemos el último número y sumamos 1
            $parts = explode('-', $lastDocument->DOC_CODIGO);
            $lastNumber = (int) end($parts);
            $consecutive = $lastNumber + 1;
        } else {
            // Si no existe ninguno, empezamos en 1
            $consecutive = 1;
        }

        return "{$pattern}{$consecutive}";
    }
}
