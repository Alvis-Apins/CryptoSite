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

    <!-- Banner-->
    <div class="relative pt-16 pb-32 flex content-center items-center justify-center min-h-screen-75">
        <div class="absolute top-0 w-full h-full bg-center bg-cover" style="background-image: url('https://imgs.search.brave.com/BtPphr-4OHXk-qo6waT35ZCPNWJERHQXa2vq-uV7wek/rs:fit:1000:666:1/g:ce/aHR0cHM6Ly93d3cu/YXVzdG9ja3Bob3Rv/LmNvbS5hdS9pbWdj/YWNoZS91cGxvYWRz/L3Bob3Rvcy9jb21w/cmVzc2VkL3BpbmUt/Zm9yZXN0LXdpdGgt/dGhlLWdsYXNzaG91/c2UtbW91bnRhaW5z/LWluLXRoZS1iYWNr/Z3JvdW5kLWF1c3Rv/Y2twaG90by0wMDAw/OTk3MzYuanBnP3Y9/MS4zLjU');">
          <span id="blackOverlay" class="w-full h-full absolute opacity-75 bg-black"></span>
        </div>
        <div class="container relative mx-auto">
            <div class="items-center flex flex-wrap">
                <div class="w-full lg:w-6/12 px-4 ml-auto mr-auto text-center">
                    <div class="pr-12">
                        <h1 class="text-white font-semibold text-5xl">
                            Crypto trading website.
                        </h1>
                        <p class="mt-4 text-lg text-gray-500">
                            This website is for buying and selling crypto assets with the latest prices, getting latest crypto headlines.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-2 md:gap-4 mt-8 mx-12 gap-6">
        @foreach($crypto_news as $article)
            <div class="relative flex flex-col min-w-0 w-full mb-6 rounded-lg">
                <img alt="..." src="{{ $article->media }}" class="w-full align-middle rounded-t-lg max-h-56"/>
                <blockquote class="relative p-8 mb-4 bg-black opacity-75 shadow-lg">
                    <h4 class="text-xl font-bold text-white">
                        {{ $article->title }}
                    </h4>
                    <p class="text-md font-light mt-2 text-white mb-6">
                        {{ $article->content }}
                    </p>
                    <button class="rounded border border-green-900 text-gray-50 py-1 px-2 hover:bg-green-900 transition duration-500 hover:scale-105"><a href="{{ $article->link }}" target="_blank"> Read more </a></button>
                </blockquote>

            </div>

        @endforeach
    </div>
    <div class="pb-10 pr-4">
        {{ $crypto_news->links() }}
    </div>

    </body>
</html>
