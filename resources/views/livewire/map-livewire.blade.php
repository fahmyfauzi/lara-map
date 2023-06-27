<div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        MapBox
                    </div>
                    <div class="card-body">
                        <div wire:ignore id='map' style='width: 100%; height: 80vh;'></div>
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
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.3.slim.min.js"
        integrity="sha256-ZwqZIVdD3iXNyGHbSYdsmWP//UBokj2FHAxKuSBKDSo=" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('livewire:load', () => {
            const defaultLocation = [108.36405451799118, -7.176664699675342];
            mapboxgl.accessToken = '{{ env('MAPBOX_KEY') }}';
            var map = new mapboxgl.Map({
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
                        id,
                        iconSize,
                        locationId,
                        title,
                        image,
                        description
                    } = properties;

                    let markerElement = document.createElement('div');
                    markerElement.className = 'marker' + locationId;
                    markerElement.id = locationId;
                    markerElement.style.backgroundImage =
                        'url(data:image/png;base64,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)';
                    markerElement.style.backgroundSize = 'cover';
                    markerElement.style.width = '50px';
                    markerElement.style.height = '50px';

                    const imageStorage = '{{ asset('/storage/images') }}' + '/' + image;
                    const content = `
                <div style="overflow-y, auto; max-height:400px, width:80%">
                    <table>
                        <tbody>
                            <tr>
                                <td>Title</td>
                                <td>${title}</td>
                            </tr>
                            <tr>
                                <td class="align-top">Picture</td>
                                <td> <img src="${imageStorage}" loading="lazy" class="img-fluid my-2" alt=""> </td>
                            </tr>
                            <tr>
                                <td class="align-top">Description</td>
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

                    new mapboxgl.Marker(markerElement)
                        .setLngLat(geometry.coordinates)
                        .setPopup(popUp)
                        .addTo(map)

                });
            }

            loadLocations({!! $geoJson !!});



        });
    </script>
@endpush
