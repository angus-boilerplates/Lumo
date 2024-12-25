<x-master-layout>
    <body class="font-sans antialiased">
        <div class="bg-base-200">

            <livewire:layout.public.navigation />

            <!-- Page Content -->
            <div class="flex flex-col min-h-screen">
                <main class="flex-1">
                    {{ $slot }}
                </main>

                <!-- Footer -->
                <livewire:layout.public.footer />
            </div>


        </div>
    </body>
</x-master-layout>
