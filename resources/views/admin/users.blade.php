@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr><th>Email</th><th>Member</th><th>Plan</th><th>Card</th><th>Next Bill</th></tr>
                    </thead>
                    <tbody>                  
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->is_member? '&#10004;' : '' }}</td>
                                <td>{{ $user->plan }}</td>
                                <td>{{ $user->card_brand }} {{ $user->card_last_four }}</td>
                                <td>{{ $user->next_bill_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>  
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
