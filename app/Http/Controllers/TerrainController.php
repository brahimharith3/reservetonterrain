<?php

namespace App\Http\Controllers;
use App\Models\Terrain;
use Illuminate\Http\Request;
use App\Models\Horaire;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

class TerrainController extends Controller
{
    public function index(){
        $terrains = Terrain::all();
        return view('terrains.index',compact('terrains'));
    }

    public function create(){
        return view('terrains.create');
    }

    public function store(Request $req){
        $req->validate([
            'nom_terrain' => 'required',
            'type_terrain' => 'required',
            'localisation' => 'required',
            'prix_heure' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:4048',
            'google_maps_embed' => 'nullable|string',
            'google_maps_link' => 'nullable|string',
        ]);

        $imageName = null;

        if ($req->hasFile('image')) {
            $imageName = time() . '.' . $req->image->extension();
            $req->image->move(public_path('terrain_images'), $imageName);
        }

        Terrain::create([
            'nom_terrain' => $req->nom_terrain,
            'type_terrain' => $req->type_terrain,
            'localisation' => $req->localisation,
            'prix_heure' => $req->prix_heure,
            'description' => $req->description,
            'image' => $imageName,
            'google_maps_embed' => $req->google_maps_embed,
            'google_maps_link' => $req->google_maps_link,
        ]);

        return redirect()->route('terrains.index')->with('success', __('messages.Terrain_ajouté'));
    }

    public function edit($id){
        $terrain = Terrain::findOrFail($id);
        return view('terrains.edit',compact('terrain'));
    }

   public function update(Request $req, $id){
        $terrain = Terrain::findOrFail($id);

        $req->validate([
            'nom_terrain' => 'required',
            'type_terrain' => 'required',
            'localisation' => 'required',
            'prix_heure' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:4048',
            'google_maps_embed' => 'nullable|string',
            'google_maps_link' => 'nullable|string|url',
        ]);

        $imageName = $terrain->image;

        if ($req->hasFile('image')) {
            $imageName = time() . '.' . $req->image->extension();
            $req->image->move(public_path('terrain_images'), $imageName);
        }

        $terrain->update([
            'nom_terrain' => $req->nom_terrain,
            'type_terrain' => $req->type_terrain,
            'localisation' => $req->localisation,
            'prix_heure' => $req->prix_heure,
            'description' => $req->description,
            'image' => $imageName,
            'google_maps_embed' => $req->google_maps_embed,
            'google_maps_link' => $req->google_maps_link,
        ]);

        return redirect()->route('terrains.index')->with('success', __('messages.Terrain_modifié'));
    }
    
    // public function delete($id){
    //     $terrain = Terrain::findOrFail($id);

    //     $terrain->delete();

    //     return redirect('/terrains');
    // }
    public function delete($id){
        $terrain = Terrain::findOrFail($id);
        if ($terrain->image && File::exists(public_path('terrain_images/' . $terrain->image))) {
            File::delete(public_path('terrain_images/' . $terrain->image));
        }
        $terrain->delete();

        return redirect()->route('terrains.index')->with('success', __('messages.Terrain_supprimé'));
    }

    public function home(Request $request){
        $query = Terrain::query()->withCount([
            'horaires as horaires_libres_count' => function ($q) {
            $q->where(function ($q2) {
                $q2->whereDate('date_horaire', '>', now()->toDateString())
                    ->orWhere(function ($q3) {
                        $q3->whereDate('date_horaire', now()->toDateString())
                        ->whereTime('heure_debut', '>', now()->format('H:i:s'));
                    });
            })
            ->whereDoesntHave('reservations', function ($r) {
                $r->whereIn('statut', ['en_attente', 'confirmee']);
            });
        }
        ]);



        if ($request->filled('search')) {
            $query->where('nom_terrain', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('type')) {
            $query->where('type_terrain', 'like', '%' . $request->type . '%');
        }

        if ($request->filled('localisation')) {
            $query->where('localisation', 'like', '%' . $request->localisation . '%');
        }

        if ($request->filled('prix_max')) {
            $query->where('prix_heure', '<=', $request->prix_max);
        }

        // $terrains = $query->get();
        $terrains = $query->get()->groupBy('type_terrain');

        return view('terrains.home', compact('terrains'));
    }

    public function show($id){
        $terrain = Terrain::findOrFail($id);

        $horaires = Horaire::where('id_terrain', $id)->where(function ($q) {
                $q->whereDate('date_horaire', '>', now()->toDateString())->orWhere(function ($q2) {
                    $q2->whereDate('date_horaire', now()->toDateString())->whereTime('heure_debut', '>', now()->format('H:i:s'));
                });
            })
            ->whereDoesntHave('reservations', function ($q) {
                $q->whereIn('statut', ['en_attente', 'confirmee']);
            }) ->orderBy('date_horaire') ->orderBy('heure_debut')->get();

            
            
        $ville = $terrain->localisation;

        $response = Http::get("https://api.openweathermap.org/data/2.5/weather", [
            'q' => $ville,
            'appid' => env('WEATHER_API_KEY'),
            'units' => 'metric',
            'lang' => 'fr'
        ]);

        // dd($response->status(), $response->json());
        


        $meteo = null;

        if ($response->successful()) {

            $data = $response->json();

            $meteo = [
                'temperature' => $data['main']['temp'],
                'description' => $data['weather'][0]['description'],
                'icon' => $data['weather'][0]['icon'],
            ];
        }
        // return view('terrain.show', compact('terrain','horaires','meteo'));

        return view('terrains.show', compact('terrain', 'horaires','meteo'));
    }
}
        