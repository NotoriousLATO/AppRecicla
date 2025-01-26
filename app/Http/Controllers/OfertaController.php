<?php

namespace App\Http\Controllers;

use App\Models\Oferta;
use App\Models\User;
use App\Models\HistorialOferta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class OfertaController extends Controller
{
    // Mostrar el formulario para crear una nueva oferta (Solo para vendedores)
    public function create()
    {
        if (Auth::user()->role !== 'vendedor') {
            return redirect()->route('oferta.index')->withErrors(['role' => 'Solo los vendedores pueden crear ofertas.']);
        }

        return view('oferta.create');
    }

    // Guardar la nueva oferta creada por el vendedor
    public function store(Request $request)
{
    $request->validate([
        'latitud' => 'required|numeric',
        'longitud' => 'required|numeric',
        'cantidad' => 'required|numeric',
        'precio' => 'required|numeric',
        'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'material' => 'required|string|max:255',
    ]);

    // Procesar la imagen
    $imagePath = null;
    if ($request->hasFile('imagen')) {
        // Guardar la imagen en public/images y obtener la ruta
        $imagePath = $request->file('imagen')->store('images', 'public');
        // Verificar si el archivo se guardó correctamente
        if (!$imagePath) {
            return back()->withErrors(['imagen' => 'Hubo un error al guardar la imagen.']);
        }
    }

    try {
        Oferta::create([
            'usuario_id' => Auth::id(),
            'latitud' => $request->latitud,
            'longitud' => $request->longitud,
            'cantidad' => $request->cantidad,
            'precio' => $request->precio,
            'image' => $imagePath,
            'material' => $request->material,
        ]);

        return redirect()->route('oferta.index')->with('success', 'Oferta creada exitosamente.');
    } catch (\Exception $e) {
        return back()->withErrors(['error' => 'Error al crear la oferta: ' . $e->getMessage()]);
    }
}

    

    // Ver las ofertas disponibles para recolectores (y vendedores si es necesario)
    public function index(Request $request)
    {
        $ofertas = Oferta::with('usuario');
    
        // Filtros de búsqueda
        if ($request->filled('estado')) {
            $ofertas->where('estado', $request->estado);
        }
    
        if ($request->filled('precio_min')) {
            $ofertas->where('precio', '>=', $request->precio_min);
        }
    
        if ($request->filled('precio_max')) {
            $ofertas->where('precio', '<=', $request->precio_max);
        }
    
        $ofertas = $ofertas->paginate(10);
    
        foreach ($ofertas as $oferta) {
            $oferta->direccion = $this->getDireccion($oferta->latitud, $oferta->longitud, false);
        }
    
        return view('oferta.index', compact('ofertas'));
    }
    

    // Función para obtener la dirección a partir de la latitud y longitud
    private function getDireccion($latitud, $longitud, $completa = false)
    {
        $apiKey = 'AIzaSyDX8c0ulrUE5aUsefFR-EXM1NQlIAa8QyU';
        $url = "https://maps.googleapis.com/maps/api/geocode/json?latlng={$latitud},{$longitud}&key={$apiKey}";

        $response = Http::get($url);
        $data = $response->json();

        if (isset($data['results'][0]['formatted_address'])) {
            $direccion = $data['results'][0]['formatted_address'];
            return !$completa && strlen($direccion) > 100 ? substr($direccion, 0, 60) . '...' : $direccion;
        }

        return 'Dirección no disponible';
    }

    // Aceptar una oferta como recolector
    public function aceptarOferta($id)
    {
        $oferta = Oferta::findOrFail($id);

        if (Auth::user()->role !== 'recolector') {
            return back()->withErrors(['role' => 'Solo los recolectores pueden aceptar ofertas.']);
        }

        if ($oferta->estado !== 'disponible') {
            return back()->withErrors(['estado' => 'La oferta ya ha sido aceptada o rechazada.']);
        }

        try {
            HistorialOferta::create([
                'oferta_id' => $oferta->id,
                'recolector_id' => Auth::id(),
                'estado' => 'aceptada',
            ]);

            $oferta->update(['estado' => 'aceptada']);
            return redirect()->route('oferta.index')->with('success', 'Oferta aceptada exitosamente.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error al aceptar la oferta.']);
        }
    }

    // Rechazar una oferta como recolector
    public function rechazarOferta($id)
    {
        $oferta = Oferta::findOrFail($id);

        if (Auth::user()->role !== 'recolector') {
            return back()->withErrors(['role' => 'Solo los recolectores pueden rechazar ofertas.']);
        }

        if ($oferta->estado !== 'disponible') {
            return back()->withErrors(['estado' => 'La oferta ya ha sido aceptada o rechazada.']);
        }

        try {
            HistorialOferta::create([
                'oferta_id' => $oferta->id,
                'recolector_id' => Auth::id(),
                'estado' => 'rechazada',
            ]);

            $oferta->update(['estado' => 'rechazada']);
            return redirect()->route('oferta.index')->with('error', 'Oferta rechazada.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error al rechazar la oferta.']);
        }
    }

    // Ver detalles de una oferta
    public function show($id)
    {
        $oferta = Oferta::with('usuario')->findOrFail($id);
        $oferta->direccion = $this->getDireccion($oferta->latitud, $oferta->longitud, true);

        return view('oferta.show', compact('oferta'));
    }
}
