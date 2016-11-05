<?php

namespace Helderwmarcos\Interbits\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InterbitsUsuario extends Model
{
    use SoftDeletes;

    protected $fillable = ['nome', 'cargo_id', 'email', 'ddd', 'celular', 'senha'];
    protected $dates = ['deleted_at'];

    /**
     * Fazendo a relação ManyToOne
     *
     * Um usuário pertence a um cargo
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cargo()
    {
        return $this->belongsTo(InterbitsCargo::class);
    }

    /**
     * Formatando a data
     *
     * Retornando a data de cadastro no formatada dd/mm/YYYY
     *
     * @param $value
     * @return string
     */
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

}
