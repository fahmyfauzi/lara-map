<div>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        MapBox
                    </div>
                    <div class="card-body">
                        <div wire:ignore id='map' style='width: 100%; height: 80vh;'></div>
                    </div>
                </div>

            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        Form
                    </div>
                    <div class="card-body">

                        <form
                            @if ($isEdit) wire:submit.prevent="updateLocation" @else
                            wire:submit.prevent="saveLocation" @endif>
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="long">Longtitude</label>
                                        <input wire:model='long' type="text" class="form-control">
                                        @error('long')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="lat">Lattitude</label>
                                        <input wire:model='lat' type="text" class="form-control">
                                        @error('lat')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label for="title">Title</label>
                                <input wire:model='title' type="text" class="form-control">
                                @error('title')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label for="virtual_tour">URL Virtual Tour</label>
                                <input wire:model='virtual_tour' type="text" class="form-control">
                                @error('virtual_tour')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label for="description">Description</label>
                                <textarea wire:model="description" class="form-control" rows="4"></textarea>
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label for="image">Picture</label>
                                <input wire:model="image" type="file" class="form-control">
                                @if ($image)
                                    <img src="{{ $image->temporaryUrl() }}" class="img-fluid my-2" alt="">
                                @endif
                                @if ($imageUrl && !$image)
                                    <img src="{{ asset('/storage/images/' . $imageUrl) }}" class="img-fluid my-2"
                                        alt="">
                                @endif
                                @error('image')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group mb-2">
                                <button type="submit"
                                    class="btn btn-dark btn-block text-white">{{ $isEdit
                                        ? "Update
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            Location"
                                        : 'Submit Location' }}</button>
                                @if ($isEdit)
                                    <button wire:click="deleteLocation" type="button"
                                        class="btn btn-danger btn-block text-white">Delete</button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>




</div>
@push('styles')
    <style>
        .multi-line-text-truncate {
            overflow: hidden;
            max-width: 350px;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
        }
    </style>
@endpush
@php
    $localImagePath = asset('image/marker.png');
@endphp
@push('scripts')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.slim.min.js"
        integrity="sha256-ZwqZIVdD3iXNyGHbSYdsmWP//UBokj2FHAxKuSBKDSo=" crossorigin="anonymous"></script>


    <script>
        document.addEventListener('livewire:load', () => {
            const defaultLocation = [108.36405451799118, -7.176664699675342];
            mapboxgl.accessToken = '{{ env('MAPBOX_KEY') }}';
            let map = new mapboxgl.Map({
                container: 'map',
                style: 'mapbox://styles/mapbox/streets-v11',
                center: defaultLocation,
                zoom: 11.15

            });

            const loadLocations = (geoJson) => {
                geoJson.features.forEach((location) => {
                    const {
                        geometry,
                        properties
                    } = location;

                    const {
                        iconSize,
                        locationId,
                        title,
                        image,
                        description,
                        virtual_tour
                    } = properties;

                    let markerElement = document.createElement('div');
                    markerElement.className = 'marker' + locationId;
                    markerElement.id = locationId;
                    markerElement.style.backgroundImage =
                        'url(' + {!! json_encode($localImagePath) !!} + ')';
                    markerElement.style.backgroundSize = 'cover';
                    markerElement.style.width = '30px';
                    markerElement.style.height = '30px';

                    const imageStorage = '{{ asset('/storage/images') }}' + '/' + image;
                    const content = `
                <div style="overflow-y, auto; max-height:400px, width:80%">
                    <table>
                        <tbody>
                            <tr>
                                <th>Title</th>
                                <td>${title}</td>
                            </tr>
                            <tr>
                                <th class="align-top">Picture</th>
                                <td> <img src="${imageStorage}" loading="lazy" class="img-fluid my-2" alt="${title}"> </td>
                            </tr>
                            <tr>
                                <th class="align-top">Description</th>
                                <td class="multi-line-text-truncate">${description}</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="multi-line-text-truncate d-flex justify-content-end"><a href="/${locationId}" class="btn btn-sm btn-primary">Readmore / Virtual Tour</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                `;
                    const popUp = new mapboxgl.Popup({
                        offset: 25
                    }).setHTML(content).setMaxWidth("400px");

                    markerElement.addEventListener('click', (e) => {
                        const locationId = e.target.id;

                        @this.findLocationById(locationId);
                    })



                    new mapboxgl.Marker(markerElement)
                        .setLngLat(geometry.coordinates)
                        .setPopup(popUp)
                        .addTo(map)

                });
            }

            loadLocations({!! $geoJson !!});

            window.addEventListener('locationAdded', (e) => {
                swal({
                    title: "Location Added!",
                    text: "Your location has been save sucessfully!",
                    icon: "success",
                    button: "Ok",
                }).then((value) => {

                    loadLocations(JSON.parse(e.detail));
                });
            });
            window.addEventListener('updateLocation', (e) => {
                swal({
                    title: "Location Updated!",
                    text: "Your location has been updated!",
                    icon: "success",
                    button: "Ok",
                }).then((value) => {
                    loadLocations(JSON.parse(e.detail));
                    $('.mapboxgl-popup').remove();
                });

            });
            window.addEventListener('deleteLocation', (e) => {
                swal({
                    title: "Location Updated!",
                    text: "Your location has been updated!",
                    icon: "success",
                    button: "Ok",
                }).then((value) => {
                    loadLocations({!! $geoJson !!});

                    $('.mapboxgl-popup').remove();
                    $('.marker' + e.detail).remove();
                });


            });
            map.addControl(new mapboxgl.NavigationControl())

            map.on('click', (e) => {
                const longtitude = e.lngLat.lng;
                const lattitude = e.lngLat.lat;

                @this.long = longtitude;
                @this.lat = lattitude;
                // console.log(longtitude,lattitude);
            });



        });
    </script>
@endpush
