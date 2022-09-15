<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
    <div>
        @include('components.logo')
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 shadow-md bg-black opacity-50 text-opacity-0 overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
