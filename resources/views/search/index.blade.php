@extends('layouts.app')

@section('content')
<div class="container">
    @if ($message = Session::get('success'))

    <div class="alert alert-success alert-block">
    
        <button type="button" class="close" data-dismiss="alert">×</button>	
    
        <strong>{{ $message }}</strong>
    
    </div>
    
    @endif
    <div class="row">
        <div class="col-sm-11"><h2>Restaurants Found</h2></div>
    </div>
    <div class="table1">
        <table class="table table-hover table-striped">
            <thead class = "tablenew">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Address</th>
                    <th scope="col">Contact</th>
                </tr>
            </thead>
            <tbody class="tablebody">
                @foreach ($restaurants as $restaurant)
                    <tr>
                        <td>{{$restaurant->name}}</td>
                        <td>{{$restaurant->address}}</td>
                        <td>{{$restaurant->contact}}</td>
                    </tr>
                @endforeach
            
            </tbody>
        </table> 
    </div>

</div>
    
@endsection