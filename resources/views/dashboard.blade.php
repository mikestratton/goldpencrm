<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 style="font-size:24px;">Simplify the process for tracking interactions with potential & existing customers in two easy steps.</h1>
                    <br>
                    1. Create a new prospect to store customer contact information, including the customers status in their willingness to purchase. <br>
                    2. Create a note when you have made contact with a specific customer to capture details and update status.
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
