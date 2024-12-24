<x-master-layout>
    <body class="font-sans antialiased">
        <div class="bg-base-200">

            <!-- Page Content -->
            <div class="flex flex-col min-h-screen">
                <main class="flex-1">
                    {{ $slot }}
                </main>
            </div>


        </div>
    </body>
</x-master-layout>
