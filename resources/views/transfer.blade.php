<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transfer') }}
        </h2>
        <div class="py-12" style="display: flex; justify-content: center; align-items: center;">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="container">
                        @if (session('success'))
                        <div class="alert alert-success" style="background-color: yellow; color: white;">
                            {{ session('success') }}
                            </div>
                        @endif
                        <h1>Money Transfer Form</h1> <hr>
                        <form action="/transfermoney" method="POST">
                            @csrf <!-- Include CSRF token for form submission -->
                            <div style="margin-bottom: 1rem;">
                                <label for="recipient" style="display: block;">Recipient:</label>
                                <input type="text" name="recipient_email" id="recipient_email" style="width: 100%;" required>
                            </div>
                            <div style="margin-bottom: 1rem;">
                                <label for="amount" style="display: block;">Amount:</label>
                                <input type="number" name="amount" id="amount" style="width: 100%;" required>
                            </div>
                            <!-- Other form fields and validations as needed -->
                            <button style="background-color: #4c9bff; color: #fff; padding: 0.75rem 1rem; border: none; cursor: pointer; margin: 0 auto; width: 100%; max-width: 300px;">Transfer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
    </x-slot>
</x-app-layout>
