</!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
.pagination {
  display: inline-block;
}

.pagination a {
  color: black;
  float: left;
  padding: 8px 16px;
  text-decoration: none;
}

.pagination a.active {
  background-color: #4CAF50;
  color: white;
  border-radius: 2px;
}

.pagination a:hover:not(.active) {
  background-color: blue;
  border-radius: 5px;
}
</style>


</head>
<body>

</body>
</html>
<x-app-layout>

    <!-- Optional theme -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Transactions') }}
        </h2>
    </x-slot>

    <div class="py-12">
       
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
             @if(session('success'))
    <div class="alert alert-success" style="align-content: center;">
        {{ session('success') }}
    </div>
@endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="px-6 py-2"># </th>
                                <th  class="px-6 py-2">Date</th>
                    <th class="px-6 py-2">Type</th>
                    <th class="px-6 py-2">Amount</th>
                   
                    <th class="px-6 py-2">Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $counter = 1;
                            @endphp
                            @foreach($transactions as $transaction)
                            
                              
                                    <tr class="bg-gray-100">
                                        <td class="border px-6 py-2">{{ $transactions->firstItem() + $loop->index }}</td>
                                        <td class="px-6 py-3">{{ $transaction->created_at }}</td>
                                        <td class="px-6 py-3">{{ ucfirst($transaction->type) }}</td>
                                        <td class="px-6 py-3">{{ $transaction->amount }}</td>
                                        
                                        <td class="px-6 py-3">{{ $user->balance }}</td>
                                    </tr>
                                    
                                    
                                   
               
                                      @php
                                        $counter++;
                                        @endphp
                                 
                            @endforeach
                        </tbody>
                    </table>
                     {{ $transactions->links() }}
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
@if(session('success'))
    <script>
        setTimeout(function() {
            document.querySelector('.alert').style.display = 'none';
        }, 1400); 
        
    </script>
@endif
