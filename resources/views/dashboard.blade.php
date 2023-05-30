<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
  

        <div class="py-12" style="display: flex; justify-content: center; align-items: center;">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @auth
    <div class="card">
        <h2>Welcome  {{ auth()->user()->name }}</h2>
        <p>YOUR ID: {{ auth()->user()->email }}</p>
        <p>YOUR BALANCE:{{$balance}}</p>
        <!-- Display other user details as needed -->
    </div>
@else
    <p>User is not logged in.</p>
@endauth
                </div>
            </div>
        </div>
    </div>
</x-slot>
</x-app-layout>
<style>
    .card {
    background-color: #ffffff;
    border: 1px solid #e2e8f0;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.card h2 {
    font-size: 24px;
    margin-bottom: 10px;
}

.card p {
    font-size: 16px;
    margin-bottom: 8px;
}

</style>