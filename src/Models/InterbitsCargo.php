<?php

namespace Helderwmarcos\Interbits\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class InterbitsCargo extends Model
{
    use SoftDeletes;

    protected $fillable = ['nome'];
    protected $dates = ['deleted_at'];

    /**
     * Relação ManyToOne
     *
     * Fazendo a relação entre cargos e usuários
     * Um cargo possui vários usuários relacionado a ele
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function usuarios()
    {
        return $this->hasMany(InterbitsUsuario::class);
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
