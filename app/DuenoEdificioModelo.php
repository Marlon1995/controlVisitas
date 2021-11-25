<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DuenoEdificioModelo extends Model
{
    protected $table = 'DuenoEdificio';
    protected $primaryKey = 'idDuenoEdificio';
    protected $fillable = ['idUsuario', 'idEdificio', 'Estado', 'Creacion', 'Modificacion'];
    public $timestamps = false;

    public static function getExcerpt($str, $startPos = 0, $maxLength = 50)
    {
        if (strlen($str) > $maxLength) {
            $excerpt = substr($str, $startPos, $maxLength - 6);
            $lastSpace = strrpos($excerpt, ' ');
            $excerpt = substr($excerpt, 0, $lastSpace);
            $excerpt .= ' [...]';
        } else {
            $excerpt = $str;
        }

        return $excerpt;
    }

}