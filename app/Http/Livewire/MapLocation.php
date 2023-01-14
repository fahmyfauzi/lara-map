<?php

namespace App\Http\Livewire;

use App\Models\Location;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class MapLocation extends Component
{
    public $long, $lat, $title, $description, $image, $locationId;
    public $geoJson;
    public $imageUrl;
    use WithFileUploads;

    private function loadLocations()
    {
        $locations = Location::orderBy('created_at', 'desc')->get();

        $customLocations = [];

        foreach ($locations as $location) {
            $customLocations[] = [
                'type' => 'Feature',
                'geometry' => [
                    'coordinates' => [$location->long, $location->lat],
                    'type' => 'Point'
                ],
                'properties' => [
                    'locationId' => $location->id,
                    'title' => $location->title,
                    'image' => $location->image,
                    'description' => $location->description

                ]
            ];
        }
        $geoLocation = [
            'type' => 'FeatureCollection',
            'features' => $customLocations
        ];

        // convert ke json
        $geoJson = collect($geoLocation)->toJson();
        $this->geoJson = $geoJson;
    }
    private function clearForm()
    {
        $this->long = '';
        $this->lat = '';
        $this->title = '';
        $this->description = '';
        $this->image = '';
    }

    public function saveLocation()
    {
        $this->validate([
            'long' => 'required',
            'lat' => 'required',
            'title' => 'required',
            'description' => 'required',
            'image' => 'image|max:2048|required',
        ]);
        $imageName = md5($this->image . microtime()) . '.' . $this->image->extension();

        Storage::putFileAs(
            'public/images', //penyimpanan
            $this->image, //sumber
            $imageName //nama
        );

        Location::create([
            'long' => $this->long,
            'lat' => $this->lat,
            'title' => $this->title,
            'description' => $this->description,
            'image' => $imageName
        ]);

        $this->clearForm();
        $this->loadLocations();
        $this->dispatchBrowserEvent('locationAdded', $this->geoJson);
    }

    public function findLocationById($id)
    {
        $location = Location::findOrFail($id);

        $this->locationId = $id;
        $this->long = $location->long;
        $this->lat = $location->lat;
        $this->title = $location->title;
        $this->description = $location->description;
        $this->imageUrl = $location->image;
    }

    public function render()
    {
        $this->loadLocations();
        return view('livewire.map-location');
    }
}
