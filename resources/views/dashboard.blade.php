<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="■bg-white ☐ dark: bg-gray-800 overflow-hidden shadow-sm sm: rounded-g">
                @if(auth()->user()->is_admin)
                <div class="p-6 text-white-900 dark: text-gray-100">
                    You are logged in as an admin.
                </div>
                @else
                <div class="p-6 text-white-900 Idark:text-gray-100">
                    {{("You're logged in!") }}
                </div>
                @endif
            </div>
            
        </div>
    </div>
</x-app-layout>
