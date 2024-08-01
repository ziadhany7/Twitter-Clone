<style>
    .alert {
        padding: 20px;
        margin-bottom: 15px;
        background-color: green;
        color: white;
    }

    .closebtn {
        margin-left: 15px;
        color: white;
        font-weight: bold;
        float: right;
        font-size: 22px;
        line-height: 20px;
        cursor: pointer;
        transition: 0.3s;
    }

    .closebtn:hover {
        color: black;
    }
</style>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
            <div class="alert">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                <strong>Success!</strong> {{ session('success') }}
            </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Name</th>
                                <th scope="col" class="px-6 py-3">E-mail</th>
                                <th scope="col" class="px-6 py-3">Created At</th>
                                <th scope="col" class="px-6 py-3">Status</th>
                                <th scope="col" class="px-6 py-3">Block/Unblock</th>
                                <th scope="col" class="px-6 py-3">Blocked on</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $user->name }}
                                </th>
                                <td class="px-6 py-4">{{ $user->email }}</td>
                                <td class="px-6 py-4">{{ $user->created_at->format('j M Y, g:i a') }}</td>
                                
                                <td class="px-6 py-4 {{ $user->isBanned() ? 'text-red-500' : 'text-green-500' }}">
                                    {{ $user->isBanned() ? 'Banned' : 'Active' }}
                                </td>

                                <td class="px-6 py-4">
                                    @if($user->isBanned())
                                    <form action="{{ route('users.unblock', $user) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit">Unblock</button>
                                    </form>
                                    @else
                                    <form action="{{ route('users.block', $user) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit">Block</button>
                                    </form>
                                    @endif
                                </td>
                                
                                <td class="px-6 py-4">
                                    @if($user->banned_at)
                                    {{ $user->banned_at }}
                                    @else
                                    N/A
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center">No Users Found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>