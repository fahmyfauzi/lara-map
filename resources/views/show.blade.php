@extends('layouts.app')

@section('content')
    <h1 class="text-bold text-center">{{ $data->title }}</h1>
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-4">
                <img src="{{ asset('storage/images/' . $data->image) }}" class="img-fluid rounded rounded-sm" alt="...">
            </div>
            <div class="col-md-8">
                {!! $data->description !!}
            </div>
        </div>
        <div class="row justify-content-center">
            <span class="border-dark rounded rounded-lg border p-2">

                <iframe id="panoee-tour-embeded" name="testing aja" src="https://tour.panoee.com/iframe/testing-aja"
                    frameborder="0" width="100%" height="500px" scrolling="no" allowvr="yes"
                    allow="vr; xr; accelerometer; gyroscope; autoplay;" allowfullscreen="false"
                    webkitallowfullscreen="false" mozallowfullscreen="false" loading="eager"></iframe>

            </span>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        var pano_iframe_name = 'panoee-tour-embeded';
        window.addEventListener('devicemotion', function(e) {
            var iframe = document.getElementById(pano_iframe_name);
            if (iframe)
                iframe.contentWindow.postMessage({
                        type: 'devicemotion',
                        deviceMotionEvent: {
                            acceleration: {
                                x: e.acceleration.x,
                                y: e.acceleration.y,
                                z: e.acceleration.z,
                            },
                            accelerationIncludingGravity: {
                                x: e.accelerationIncludingGravity.x,
                                y: e.accelerationIncludingGravity.y,
                                z: e.accelerationIncludingGravity.z,
                            },
                            rotationRate: {
                                alpha: e.rotationRate.alpha,
                                beta: e.rotationRate.beta,
                                gamma: e.rotationRate.gamma,
                            },
                            interval: e.interval,
                            timeStamp: e.timeStamp,
                        },
                    },
                    '*'
                );
        });
    </script>
@endpush
