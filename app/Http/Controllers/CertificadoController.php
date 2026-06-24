<?php

namespace App\Http\Controllers;

use App\Models\Certificado;
use App\Models\Materia;
use Illuminate\Http\Request;

class CertificadoController extends Controller
{
    public function webIndex()
    {
        $user = auth()->user();
        $certificados = \App\Models\Certificado::where('user_id', $user->id)
                                            ->with('materia')
                                            ->get();

        return view('certificados', compact('certificados'));
    }
    
    // Listar certificados del usuario autenticado
    public function index(Request $request)
    {
        $certificados = Certificado::where('user_id', $request->user()->id)
            ->with('materia')
            ->get();
        return response()->json($certificados, 200);
    }

    // Generar certificado (se llama automáticamente al completar una materia)
    public function generar($userId, $materiaId)
    {
        $existe = Certificado::where([
            'user_id' => $userId,
            'materia_id' => $materiaId,
        ])->exists();

        if (!$existe) {
            Certificado::create([
                'user_id' => $userId,
                'materia_id' => $materiaId,
                'fecha_emision' => now(),
            ]);
        }
    }
}