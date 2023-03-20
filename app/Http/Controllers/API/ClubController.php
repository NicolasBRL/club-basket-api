<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Club;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClubController extends Controller
{
    public function index()
    {
        $clubs = DB::table('clubs')
            ->get()
            ->toArray();
        return response()->json([
            'status' => 'Success', 'data' => $clubs,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nameClub' => 'required|max:100',
        ]);
        $club = Club::create([
            'nameClub' => $request->nameClub,
        ]);
        return response()->json([
            'status' => 'Success', 'data' => $club,
        ]);
    }

    public function show(Club $club)
    {
        return response()->json($club);
    }

    public function update(Request $request, Club $club)
    {
        $this->validate($request, [
            'nameClub' => 'required|max:100',
        ]);

        $club->update([
            'nameClub' => $request->nameClub,
        ]);
        return response()->json([
            'status' => 'Mise à jour avec succèss'
        ]);
    }

    public function destroy(Club $club)
    {
        return response()->json([
            'status' => 'Supprimer avec succès']);
    }
}
