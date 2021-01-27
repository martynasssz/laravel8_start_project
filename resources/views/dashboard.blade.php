<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Hi.. <b> {{ Auth::user()->name }}</b> <!-- accsess login user-->
            <b style="float:right;">Total Users 
            <span class="badge badge-danger">{{count($users)}}</span> <!-- we will count users (passed for web.php)-->
            </b>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">SL No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">reated_at</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php($i = 1) 
                      @foreach($users as $user)  
                      <tr>
                        <th scope="row">{{ $i++ }}</th> <!-- i++ automatic increment-->
                        <td>{{ $user->name }}</td> <!-- $user access name-->
                        <td>{{ $user->email }}</td>
                        {{-- <!-- <td>{{ $user->created_at->diffForHumans() }}</td> we will change format using Eloquen ORM  (laravel default function diffForHumans() ) --> --}}
                        <td>{{ Carbon\Carbon::parse($user->created_at)->diffForHumans() }}</td> {{-- use carbon in blades when in controler use query builder --}}
                    </tr> 
                      @endforeach                    
                    </tbody>
                  </table>    
            </div>
        </div>
    </div>
</x-app-layout>
