<div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

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
            const defaultLocation = [108.21189532485045, -7.330317292259124];
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
                    markerElement.style.backgroundImage = 'url(' + '/storage/images/' + image + ')';
                    markerElement.style.backgroundSize = 'cover';
                    markerElement.style.width = '200px';
                    markerElement.style.height = '130px';

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
                                <td> <img src="${imageStorage}" loading="lazy" class="img-fluid my-2" alt=""> </td>
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
