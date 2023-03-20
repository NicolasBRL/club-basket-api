<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlayerController extends Controller
{
    public function index()
    {
        // On récupère tous les joueurs
        $players = DB::table('players')
            ->join('clubs', 'clubs.id', '=', 'players.club_id')
            ->get()
            ->toArray();
        // On retourne les informations des utilisateurs en JSON
        return response()->json([
            'status' => 'Success', 'data' => $players,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'firstName' => 'required|max:100', 
            'lastName' => 'required|max:100', 
            'height' => 'required|max:100', 
            'position' => 'required|max:100',
        ]);
        // On crée un nouvel utilisateur
        $player = Player::create([
            'firstName' => $request->firstName, 
            'lastName' => $request->lastName, 
            'height' => $request->height, 
            'position' => $request->position,
            'club_id' => $request->club_id,
        ]);
        // On retourne les informations du nouvel utilisateur en JSON
        return response()->json([
            'status' => 'Success', 'data' => $player,
        ]);
    }


    public function show(Player $player)
    {
        return response()->json($player);
    }

    public function update(Request $request, Player $player)
    {
        $this->validate($request, [
            'firstname' => 'required|max:100',
            'lastname' => 'required|max:100', 
            'height' => 'required|max:100', 
            'position' => 'required|max:100',
        ]);
        
        // On crée un nouvel utilisateur
        $player->update([
            'firstname' => $request->firstname, 
            'lastname' => $request->lastname, 
            'height' => $request->height, 
            'lastname' => $request->lastname, 
            'position' => $request->position,
            'club_id' => $request->club_id,
        ]);
        // On retourne les informations du nouvel utilisateur en JSON
        return response()->json([
            'status' => 'Mise à jour avec succèss'
        ]);
    }

    public function destroy(Player $player)
    {
        // On supprime l'utilisateur
        $player->delete();
        // On retourne la réponse JSON
        return response()->json([
            'status' => 'Supprimer avec succès avec succèss'
        ]);
    }
}
