<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oferta extends Model
{
    use HasFactory;

    // Definir las columnas que se pueden asignar masivamente
    protected $fillable = [
        'usuario_id', 'latitud', 'longitud', 'cantidad', 'precio','material', 'image'//campos uevos material y image 
    ];

    // Relación con el modelo Usuario (Vendedor)
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    // Relación con el historial de ofertas (aceptadas/rechazadas por recolectores)
    public function historial()
    {
        return $this->hasMany(HistorialOferta::class);
    }
    public function getImageUrlAttribute()
{
    return $this->image ? asset('storage/' . $this->image) : null;
}

}
