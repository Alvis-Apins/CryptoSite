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

<div class="flex justify-center mb-40">
    <div class="bg-black opacity-75 rounded h-fit max-w-md">
        <div class="rounded">
            <img class="rounded" src="https://images.pexels.com/photos/50987/money-card-business-credit-card-50987.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Credit card img">
        </div>
        <div class="py-2 px-4 mt-6">
            <label for="chname" class="text-white"> Card holders full name </label>
            <input class="w-full bg-gray-400 rounded-lg shadow-md mt-2 placeholder-black" type="text" id="chname" name="chname" placeholder="J. Quincy Magoo">
        </div>
        <div class="py-2 px-4">
            <label for="card-number" class="text-white"> Card number </label>
            <input class="w-full bg-gray-400 rounded-lg shadow-md mt-2 placeholder-black" type="text" id="card-number" name="card-number" placeholder="**** **** **** ****">
        </div>
        <div class="py-2 px-4">
            <label for="expiration" class="text-white"> Expiration date </label>
            <div class="flex justify-between">
                <div>
                    <input class="w-32 rounded-lg shadow-md mt-2 placeholder-black bg-gray-400" type="text" id="expiration" name="cvc" placeholder="June">
                    <input class="w-24 rounded-lg shadow-md mt-2 mx-6 placeholder-black bg-gray-400" type="text" id="year" name="cvc" placeholder="2022">
                </div>
                <div>
                    <input class="w-20 rounded-lg shadow-md mt-2 bg-gray-400 placeholder-black" type="text" id="cvc" name="cvc" placeholder="123">
                </div>
            </div>
        </div>
        <div class="py-2 px-4 mt-4">
            <form action="{{ route('add.money') }}" method="POST">
                @csrf
                <label for="amount" class="text-white"> Amount to add </label>
                <div class="flex justify-between">
                    <div>
                        <input class="w-32 rounded-lg shadow-md mb-4" type="text" id="amount" name="amount" placeholder="0.00$">
                    </div>
                    <div>
                        <button class="ml-2 rounded border border-green-900 text-gray-50 py-1 px-4 hover:bg-green-900 transition duration-500 hover:scale-110"
                                type="submit">Add Money
                        </button>
                    </div>
                </div>
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="text-red-600">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </form>

        </div>
    </div>
</div>


</body>
</html>
