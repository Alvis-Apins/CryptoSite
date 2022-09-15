<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="custom-background">
@include('components.guest-navigation-bar')

<div class="flex justify-center">
    <div class="w-fit">
        <div class="flex justify-center px-8 ">
            <div class="overflow-x-auto ">
                <div class="flex justify-between py-2 inline-block pb-32">
                    <div class="overflow-hidden rounded">
                        <div class="flex p-2 bg-black opacity-75 text-green-50 justify-center">
                            <h1> Owned Assets </h1>
                        </div>
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
                                    Amount
                                </th>
                                <th scope="col" class="text-sm font-medium px-6 py-4 text-left">
                                    Buying_value
                                </th>
                                <th scope="col" class="text-sm font-medium px-6 py-4 text-left">
                                    Selling_value
                                </th>
                                <th scope="col" class="text-sm font-medium px-6 py-4 text-left">
                                    Status
                                </th>
                                <th scope="col" class="text-sm font-medium px-6 py-4 text-left">
                                    Sell Crypto
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($assets as $asset)
                                <tr class="bg-black bg-opacity-80 border-b border-b-black">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-white"> {{ $loop->index + 1 }} </td>
                                    <td>
                                        <div class="w-6">
                                            <img
                                                src="https://s2.coinmarketcap.com/static/img/coins/64x64/{{ $asset->crypto_id }}.png"
                                                alt="no img"/>
                                        </div>
                                    </td>
                                    <td class="text-sm text-white font-light px-6 py-4 whitespace-nowrap">
                                        {{ $asset->asset }}
                                    </td>
                                    <td class="text-sm text-white font-light px-6 py-4 whitespace-nowrap">
                                        @if($asset->amount > 100)
                                            {{ number_format($asset->amount, 0, ' ', ' ') }}
                                        @elseif($asset->amount > 10)
                                            {{ number_format($asset->amount,1) }}
                                        @else
                                            {{ number_format($asset->amount,3) }}
                                        @endif

                                    </td>
                                    <td class="text-sm text-white font-light px-6 py-4 whitespace-nowrap">
                                        $ {{ number_format($asset->buy_value,2) }}
                                    </td>
                                    <td class="text-sm text-white font-light px-6 py-4 whitespace-nowrap">
                                        $ {{ number_format($asset->sell_value,2) }}
                                    </td>
                                    @if(($asset->sell_value - $asset->buy_value) >= 0)
                                        <td class="text-sm text-green-500 font-light px-6 py-4 whitespace-nowrap">
                                            $ {{ number_format(($asset->sell_value - $asset->buy_value),2) }}
                                        </td>
                                    @else
                                        <td class="text-sm text-red-600 font-light px-6 py-4 whitespace-nowrap">
                                            $ {{ number_format(($asset->sell_value - $asset->buy_value),2) }}
                                        </td>
                                    @endif
                                    <td class="text-sm text-white font-light px-6 py-4 whitespace-nowrap">
                                        @if($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li class="text-red-600">{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        <form action="{{ route('crypto.sell') }}" method="POST">
                                            @csrf
                                            <div class="flex">
                                                <button class="mr-2 rounded border border-green-900 text-gray-50  px-4 hover:bg-green-900 transition duration-500 hover:scale-110"
                                                        type="button"
                                                        onclick="setInput({{ $asset->amount }}, {{ $loop->index }})">
                                                    All
                                                </button>
                                                <input type="hidden" id="asset" name="asset"
                                                       value="{{ $asset->asset }}">
                                                <input class="rounded shadow-md bg-green-900 bg-opacity-5 w-32"
                                                       type="text"
                                                       id="{{ $loop->index }}" name="value" placeholder="amount">
                                                <button class="ml-2 rounded border border-green-900 text-gray-50  px-4 hover:bg-green-900 transition duration-500 hover:scale-110"
                                                        type="submit">Sell
                                                </button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                        {{ $assets->links() }}
                    </div>
                </div>
                <div class="flex justify-between py-2 inline-block pb-32">
                    <div class="overflow-hidden rounded">
                        <div class="flex p-2 bg-black opacity-75 text-green-50 justify-center">
                            <h1> Sold Assets </h1>
                        </div>
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
                                    Amount
                                </th>
                                <th scope="col" class="text-sm font-medium px-6 py-4 text-left">
                                    Gains
                                </th>
                                <th scope="col" class="text-sm font-medium px-6 py-4 text-left">
                                    Sold at
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sold_assets as $asset)
                                <tr class="bg-black bg-opacity-80 border-b border-b-black">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-white"> {{ $loop->index + 1 }} </td>
                                    <td class="">
                                        <div class="w-6">
                                            <img src="https://s2.coinmarketcap.com/static/img/coins/64x64/{{ $asset->crypto_id }}.png" alt="no img"/>
                                        </div>
                                    </td>
                                    <td class="text-sm text-white font-light px-6 py-4 whitespace-nowrap">
                                        {{ $asset->asset }}
                                    </td>
                                    <td class="text-sm text-white font-light px-6 py-4 whitespace-nowrap">
                                        {{ number_format($asset->amount,2) }}
                                    </td>
                                    @if($asset->money_earned >= 0)
                                        <td class="text-sm text-green-500 font-light px-6 py-4 whitespace-nowrap">
                                            $ {{ number_format($asset->money_earned,2) }}
                                        </td>
                                    @else
                                        <td class="text-sm text-red-600 font-light px-6 py-4 whitespace-nowrap">
                                            $ {{  number_format($asset->money_earned,2) }}
                                        </td>
                                    @endif
                                    <td class="text-sm text-white font-light px-6 py-4 whitespace-nowrap">
                                        {{ $asset->sold_at }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="float-right w-1/4">
        <div class="fixed bg-black opacity-80 rounded-md shadow-md px-8 m-2 mr-6">
            <div class="bg-green-900 mt-6 rounded">
                <h1 class="text-center text-white text-2xl p-4"> Wallet Summary </h1>
            </div>


            <p class="text-gray-400 pt-8">Money to invest: {{ number_format($summary['money_to_invest'],2, '.', ' ') }} $</p>
            <p class="text-gray-400 pt-2">Money invested: {{ number_format($summary['money_invested'],2, '.', ' ') }} $</p>
            @if($summary['historic_gains'] > 0)
                <p class="text-gray-400 pt-2">Current Status: <a class="text-green-500">{{ number_format($summary['historic_gains'],2, '.', ' ') }} $</a></p>
            @else
                <p class="text-gray-400 pt-2">Current Status: <a class="text-red-600">{{ number_format($summary['historic_gains'],2, '.', ' ') }} $</a></p>
            @endif


            @if($summary['possible_gains'] > 0)
                <p class="text-green-500 pt-8 flex justify-center"> Sell Assets </p>
                <div class="w-full h-24 custom-green-background rounded mt-6 text-center">
                    <p class="text-black pt-10 text-xl"> $ {{ number_format($summary['possible_gains'],2, '.', ' ') }}</p>
                </div>
            @else
                <p class="text-red-600 pt-8 flex justify-center"> Sell Assets </p>
                <div class="w-full h-24 custom-red-background rounded mt-6 text-center">
                    <p class="text-white pt-10 text-xl"> $ {{ number_format($summary['possible_gains'],2, '.', ' ') }}</p>
                </div>
            @endif
            <div class="p-5">

                <form action="{{ route('crypto.sell.all') }}" method="POST">
                    @csrf
                    <div class="flex justify-end">
                        <button class="bg-black hover:bg-green-900 border border-green-900 text-white px-2 rounded text-lg transition duration-500 hover:scale-105"
                                type="submit">Sell All
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function setInput(amount, id) {
        document.getElementById(id).value = amount;
    }
</script>

</body>
</html>
