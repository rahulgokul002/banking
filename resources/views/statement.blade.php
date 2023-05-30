<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Statement') }}
        </h2>
    
        <div class="py-12" style="display: flex; justify-content: center; align-items: center;">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="container">
                        <div>
                            <h2>Welcome to the Dashboard!</h2><hr>
                            <p>Your balance: {{ $balance }}</p><hr>
                        
                            <h3>Account Statement</h3>
                            @php
                            $i = 1;
                        @endphp
                            <table class="statement-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Type</th>
                                        <th>Details</th>
                                        <th>Balance</th>
                                                                            
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactions as $transaction)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{ $transaction->created_at }}</td>
                                        <td>{{ $transaction->amount }}</td>
                                        <td>{{ $transaction->type }}</td>
                                        <td>{{ $transaction->details }}</td>
                                        <td>{{ $transaction->balance }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
</x-slot>
</x-app-layout>
<style>.statement-table {
    width: 100%;
    border-collapse: collapse;
    border: 1px solid #ddd;
  }
  
  .statement-table th,
  .statement-table td {
    padding: 10px;
    border: 1px solid #ddd;
  }
  
  .statement-table th {
    background-color: #f5f5f5;
    font-weight: bold;
  }
  
  .statement-table tbody tr:nth-child(even) {
    background-color: #f9f9f9;
  }
  
  .statement-table tbody tr:hover {
    background-color: #f2f2f2;
  }
  </style>
