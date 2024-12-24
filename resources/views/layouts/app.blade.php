<x-master-layout>
    <body class="font-sans antialiased">
        <div class="bg-base-200">
            <livewire:layout.navigation />

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-base-200 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <div class="flex flex-col min-h-screen">
                <main class="flex-1">
                    {{ $slot }}
                </main>

                <!-- Footer -->
                <livewire:layout.footer />
            </div>


        </div>
    </body>
</x-master-layout>
