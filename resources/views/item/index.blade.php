@extends('myframe')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left my-5">
                <h2>Welcome To MS it Laravel Online Class</h2><br>
            </div><br>
            <br>
            <div class="pull-center">
                <a class="btn btn-success" href="{{ route('item.create') }}"> Create New Item</a>
            </div>
            <br>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Category</th>
            <th>Name</th>
            <th>Price</th>
            <th>Qty</th>
            
            <th width="280px">Action</th>
        </tr>
        @foreach ($items as $item)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $item->category_id }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->price }}</td>
            <td>{{ $item->qty }}</td>
            <td>
                <form action="{{ route('item.destroy',$item->id) }}" method="POST">


                    <a class="btn btn-primary" href="{{ route('item.edit',$item->id) }}">Edit</a>


                    @csrf
                    @method('DELETE')

   
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>



@endsection
