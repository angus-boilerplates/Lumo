<x-master-layout>
    <body class="font-sans text-base-content antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-base-200 ">
            <x-authentication-card>
                {{ $slot }}
            </x-authentication-card>
        </div>
    </body>
</x-master-layout>
