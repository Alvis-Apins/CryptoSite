<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="custom-background">
@include('components.guest-navigation-bar')

<div class="grid h-full grid-cols-2 w-full">
    <div class="w-full h-full flex justify-center mb-10">
        <div class="w-2/4">
            <h3 class="flex justify-center items-center h-10 bg-black opacity-80 rounded px-32 mt-6 text-gray-50"> Best daily growers</h3>
            <div class="grid grid-cols-2 w-full">
                @foreach($daily_best as $asset)
                    <div class="w-full bg-green-900 p-8 h-20 flex items-center rounded-l mt-1">
                        <div>
                            <div class="flex">
                                <div class="w-6">
                                    <img src="https://s2.coinmarketcap.com/static/img/coins/64x64/{{ $asset->asset_id }}.png" alt="{{ $asset->asset_id }}"/>
                                </div>
                                <h4 class="font-bold pl-2"> {{ $asset->name }} </h4>
                            </div>
                            <p>$ {{ $asset->price }} </p>
                        </div>
                    </div>
                    <div class="w-full bg-black opacity-80 h-auto flex items-center justify-center rounded-r mt-1">
                        <div class="text-green-500">
                            +{{ $asset->percent_change_day }}%
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="w-full h-full flex justify-center">
        <div class="w-2/4">
            <h3 class="flex justify-center items-center h-10 bg-black opacity-80 rounded px-32 mt-6 text-gray-50"> Daily danger-zone </h3>
            <div class="grid grid-cols-2 w-full">
                @foreach($daily_worst as $asset)
                    <div class="w-full bg-green-900 p-8 h-20 flex items-center rounded-l mt-1">
                        <div>
                            <div class="flex">
                                <div class="w-6">
                                    <img src="https://s2.coinmarketcap.com/static/img/coins/64x64/{{ $asset->asset_id }}.png" alt="{{ $asset->asset_id }}"/>
                                </div>
                                <h4 class="font-bold pl-2"> {{ $asset->name }} </h4>
                            </div>
                            <p>$ {{ $asset->price }} </p>
                        </div>
                    </div>
                    <div class="w-full bg-black opacity-80 h-auto flex items-center justify-center rounded-r mt-1">
                        <div class="text-red-600">
                            {{ $asset->percent_change_day }}%
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="w-full h-full flex justify-center mb-10">
        <div class="w-2/4">
            <h3 class="flex justify-center items-center h-10 bg-black opacity-80 rounded px-32 mt-6 text-gray-50"> Best weekly growers</h3>
            <div class="grid grid-cols-2 w-full">
                @foreach($weekly_best as $asset)
                    <div class="w-full bg-green-900 p-8 h-20 flex items-center rounded-l mt-1">
                        <div>
                            <div class="flex">
                                <div class="w-6">
                                    <img src="https://s2.coinmarketcap.com/static/img/coins/64x64/{{ $asset->asset_id }}.png" alt="{{ $asset->asset_id }}"/>
                                </div>
                                <h4 class="font-bold pl-2"> {{ $asset->name }} </h4>
                            </div>
                            <p>$ {{ $asset->price }} </p>
                        </div>
                    </div>
                    <div class="w-full bg-black opacity-80 h-auto flex items-center justify-center rounded-r mt-1">
                        <div class="text-green-500">
                            +{{ $asset->percent_change_week }}%
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="w-full h-full flex justify-center">
        <div class="w-2/4">
            <h3 class="flex justify-center items-center h-10 bg-black opacity-80 rounded px-32 mt-6 text-gray-50"> Weekly danger-zone </h3>
            <div class="grid grid-cols-2 w-full">
                @foreach($weekly_worst as $asset)
                    <div class="w-full bg-green-900 p-8 h-20 flex items-center rounded-l mt-1">
                        <div>
                            <div class="flex">
                                <div class="w-6">
                                    <img src="https://s2.coinmarketcap.com/static/img/coins/64x64/{{ $asset->asset_id }}.png" alt="{{ $asset->asset_id }}"/>
                                </div>
                                <h4 class="font-bold pl-2"> {{ $asset->name }} </h4>
                            </div>
                            <p>$ {{ $asset->price }} </p>
                        </div>
                    </div>
                    <div class="w-full bg-black opacity-80 h-auto flex items-center justify-center rounded-r mt-1">
                        <div class="text-red-600">
                            {{ $asset->percent_change_week }}%
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="w-full h-full flex justify-center mb-10">
        <div class="w-2/4">
            <h3 class="flex justify-center items-center h-10 bg-black opacity-80 rounded px-32 mt-6 text-gray-50"> Best monthly growers</h3>
            <div class="grid grid-cols-2 w-full">
                @foreach($monthly_best as $asset)
                    <div class="w-full bg-green-900 p-8 h-20 flex items-center rounded-l mt-1">
                        <div>
                            <div class="flex">
                                <div class="w-6">
                                    <img src="https://s2.coinmarketcap.com/static/img/coins/64x64/{{ $asset->asset_id }}.png" alt="{{ $asset->asset_id }}"/>
                                </div>
                                <h4 class="font-bold pl-2"> {{ $asset->name }} </h4>
                            </div>
                            <p>$ {{ $asset->price }} </p>
                        </div>
                    </div>
                    <div class="w-full bg-black opacity-80 h-auto flex items-center justify-center rounded-r mt-1">
                        <div class="text-green-500">
                            +{{ $asset->percent_change_month }}%
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="w-full h-full flex justify-center">
        <div class="w-2/4">
            <h3 class="flex justify-center items-center h-10 bg-black opacity-80 rounded px-32 mt-6 text-gray-50"> Monthly danger-zone </h3>
            <div class="grid grid-cols-2 w-full">
                @foreach($monthly_worst as $asset)
                    <div class="w-full bg-green-900 p-8 h-20 flex items-center rounded-l mt-1">
                        <div>
                            <div class="flex">
                                <div class="w-6">
                                    <img src="https://s2.coinmarketcap.com/static/img/coins/64x64/{{ $asset->asset_id }}.png" alt="{{ $asset->asset_id }}"/>
                                </div>
                                <h4 class="font-bold pl-2"> {{ $asset->name }} </h4>
                            </div>
                            <p>$ {{ $asset->price }} </p>
                        </div>
                    </div>
                    <div class="w-full bg-black opacity-80 h-auto flex items-center justify-center rounded-r mt-1">
                        <div class="text-red-600">
                            {{ $asset->percent_change_month }}%
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="w-full h-full flex justify-center mb-10">
        <div class="w-2/4">
            <h3 class="flex justify-center items-center h-10 bg-black opacity-80 rounded px-32 mt-6 text-gray-50"> Best seasonal growers</h3>
            <div class="grid grid-cols-2 w-full">
                @foreach($trimester_best as $asset)
                    <div class="w-full bg-green-900 p-8 h-20 flex items-center rounded-l mt-1">
                        <div>
                            <div class="flex">
                                <div class="w-6">
                                    <img src="https://s2.coinmarketcap.com/static/img/coins/64x64/{{ $asset->asset_id }}.png" alt="{{ $asset->asset_id }}"/>
                                </div>
                                <h4 class="font-bold pl-2"> {{ $asset->name }} </h4>
                            </div>
                            <p>$ {{ $asset->price }} </p>
                        </div>
                    </div>
                    <div class="w-full bg-black opacity-80 h-auto flex items-center justify-center rounded-r mt-1">
                        <div class="text-green-500">
                            +{{ $asset->percent_change_trimester }}%
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="w-full h-full flex justify-center">
        <div class="w-2/4">
            <h3 class="flex justify-center items-center h-10 bg-black opacity-80 rounded px-32 mt-6 text-gray-50"> Seasonal danger-zone </h3>
            <div class="grid grid-cols-2 w-full">
                @foreach($trimester_worst as $asset)
                    <div class="w-full bg-green-900 p-8 h-20 flex items-center rounded-l mt-1">
                        <div>
                            <div class="flex">
                                <div class="w-6">
                                    <img src="https://s2.coinmarketcap.com/static/img/coins/64x64/{{ $asset->asset_id }}.png" alt="{{ $asset->asset_id }}"/>
                                </div>
                                <h4 class="font-bold pl-2"> {{ $asset->name }} </h4>
                            </div>
                            <p>$ {{ $asset->price }} </p>
                        </div>
                    </div>
                    <div class="w-full bg-black opacity-80 h-auto flex items-center justify-center rounded-r mt-1">
                        <div class="text-red-600">
                            {{ $asset->percent_change_trimester }}%
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


</div>




</body>
</html>
