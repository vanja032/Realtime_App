<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>RealtimeShop App</title>

        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
    </head>
    <body class="antialiased">
        <div class="container">
            <div class="row p-5">
                <?php $items = App\Models\Item::get(); ?>
                @foreach ($items as $item)
                    <div class="col-lg-4 my-2">
                        <div class="card shadow">
                            <div class="card-body">
                                <h3>{{ $item->name }}</h3>
                                <p class="text-muted">{{ $item->description }}</p>
                                <p>{{ number_format($item->price, 2, '.', ',') }}</p>
                                <button class="btn btn-primary btn-block" data-id="{{ $item->id }}">Buy</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <script src="https://cdn.socket.io/4.6.0/socket.io.min.js" integrity="sha384-c79GN5VsunZvi+Q/WObgk2in0CbZsHnjEqvFxC5DxHn9lTfNce2WW6h2pH6u/kF+" crossorigin="anonymous"></script>
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
