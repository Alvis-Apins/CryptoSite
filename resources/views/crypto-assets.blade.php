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

<div class="flex justify-center px-8 ">
    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8 ">
        <div class="flex justify-between py-2 inline-block sm:px-6 lg:px-8 pb-32">
            <div class="overflow-hidden rounded">
                <table class="min-w-full">
                    <thead class="bg-green-900 opacity-75 text-white">
                    <tr>
                        <th scope="col" class="text-sm font-medium px-6 py-4 text-left">
                            #
                        </th>
                        <th scope="col" class="text-sm font-medium px-6 py-4 text-left">
                            Icon
                        </th>
                        <th scope="col" class="text-sm font-medium px-6 py-4 text-left">
                            Name
                        </th>
                        <th scope="col" class="text-sm font-medium px-6 py-4 text-left">
                            Price
                        </th>
                        <th scope="col" class="text-sm font-medium px-6 py-4 text-left">
                            Market_cap
                        </th>
                        <th scope="col" class="text-sm font-medium px-6 py-4 text-left">
                            1_Day
                        </th>
                        <th scope="col" class="text-sm font-medium px-6 py-4 text-left">
                            1_Week
                        </th>
                        <th scope="col" class="text-sm font-medium px-6 py-4 text-left">
                            1_Month
                        </th>
                        <th scope="col" class="text-sm font-medium px-6 py-4 text-left">
                            Buy Crypto
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($assets as $asset)
                        <tr class="bg-black bg-opacity-75 border-b-black border-b">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-white"> {{ $asset->id }} </td>
                            <td class="">
                                <div class="w-6">
                                    <img
                                        src="https://s2.coinmarketcap.com/static/img/coins/64x64/{{ $asset->asset_id }}.png"
                                        alt="{{ $asset->symbol }}"/>
                                </div>
                            </td>
                            <td class="text-sm text-white font-light px-6 py-4 whitespace-nowrap">
                                {{ $asset->name }}({{ $asset->symbol }})
                            </td>
                            <td class="text-sm text-white font-light px-6 py-4 whitespace-nowrap">
                                @if($asset->price > 9999)
                                    $ {{ number_format($asset->price, 3) }}
                                @elseif($asset->price > 999)
                                    $ {{ number_format($asset->price, 4) }}
                                @elseif($asset->price > 99)
                                    $ {{ number_format($asset->price, 5) }}
                                @elseif($asset->price > 9)
                                    $ {{ number_format($asset->price, 6) }}
                                @else
                                    $ {{ number_format($asset->price, 7) }}
                                @endif
                            </td>
                            <td class="text-sm text-white font-light px-6 py-4 whitespace-nowrap">
                                $ {{ number_format($asset->market_cap) }}
                            </td>
                            <td class="text-sm font-light px-6 py-4 whitespace-nowrap">
                                @if($asset->percent_change_day>= 0)
                                    <p class="text-green-500">  {{ $asset->percent_change_day }} % </p>
                                @else
                                    <p class="text-red-500">  {{ $asset->percent_change_day }} % </p>
                                @endif
                            </td>
                            <td class="text-sm font-light px-6 py-4 whitespace-nowrap">
                                @if($asset->percent_change_week>= 0)
                                    <p class="text-green-500">  {{ $asset->percent_change_week }} % </p>
                                @else
                                    <p class="text-red-500">  {{ $asset->percent_change_week }} % </p>
                                @endif
                            </td>
                            <td class="text-sm font-light px-6 py-4 whitespace-nowrap">
                                @if($asset->percent_change_month>= 0)
                                    <p class="text-green-500">  {{ $asset->percent_change_month }} % </p>
                                @else
                                    <p class="text-red-500">  {{ $asset->percent_change_month }} % </p>
                                @endif
                            </td>
                            <td class="text-sm text-white font-light px-6 py-4 whitespace-nowrap">
                                <form action="{{ route('crypto.buy') }}" method="POST">
                                    @csrf

                                    <div class="flex">
                                        <input type="hidden" id="asset" name="asset" value="{{ $asset->name }}">
                                        <input class="rounded shadow-md bg-green-900 bg-opacity-5 w-32" type="text"
                                               name="value" placeholder="0.00 $">
                                        <button class="ml-2 rounded border border-green-900 text-gray-50 py-1 px-4 hover:bg-green-900 transition duration-500 hover:scale-110" href="#popup1"
                                                type="submit">Buy
                                        </button>
                                    </div>
                                    @if($errors->any())
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li class="text-red-600">{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    @endif

                                </form>
                            </td>
                        </tr>
                    @endforeach


                    </tbody>
                </table>
                {{ $assets->links() }}
            </div>
        </div>
    </div>
</div>


</body>
</html>
