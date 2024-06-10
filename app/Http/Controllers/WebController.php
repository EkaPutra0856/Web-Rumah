<?php

namespace App\Http\Controllers;

use App\Models\Coordinate;
use Illuminate\Http\Request;
use App\Models\Marker; // Sesuaikan dengan nama model Anda
use App\Models\Region;
use App\Models\Rumah;

class WebController extends Controller
{
    public function map()
    {
        $markers = [];
        $polygons = [];

        $regions = Region::all();
        foreach ($regions as $region) {
            // Ambil semua marker berdasarkan region_id
            $regionMarkers = Coordinate::where('region_id', $region->id)->get();

            // Jika jumlah marker lebih dari 3, tambahkan ke polygons
            if ($regionMarkers->count() >= 3) {
                $polygonCoordinates = [];
                foreach ($regionMarkers as $marker) {
                    $polygonCoordinates[] = [$marker->latitude, $marker->longitude];
                }
                $polygons[] = $polygonCoordinates;
            } else {
                // Jika kurang dari 3, tambahkan ke markers
                foreach ($regionMarkers as $marker) {
                    $markers[] = [
                        'latitude' => $marker->latitude,
                        'longitude' => $marker->longitude,
                    ];
                }
            }
        }
        $rumah = Rumah::all();
        foreach ($rumah as $rumah) {
            // Ambil semua marker berdasarkan region_id
            $rumahMarkers = Rumah::where('id', $rumah->id)->get();

            $color = 'Chartreuse';

            if($rumah->status == 'Sehat'){
                $color = 'Chartreuse';
            } else if ($rumah->status == 'tidak layak'){
                $color = 'Pink';
            } else {
                $color = 'black';
            }

           
            
                // Jika kurang dari 3, tambahkan ke markers
                foreach ($rumahMarkers as $marker) {
                    $markers[] = [
                        'latitude' => $marker->latitude,
                        'longitude' => $marker->longitude,
                    ];
                }
            }
        

        return view('map', compact('markers', 'polygons', 'color'));
    }
}
