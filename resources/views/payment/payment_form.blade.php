@extends('welcome')
@section('specifyContent')
<form action="{{ route('payos.create') }}" method="POST">
    @csrf
    <input type="number" name="amount" placeholder="Amount (VND)" required>
    <input type="text" name="description" placeholder="Description" required>
    <button type="submit">Pay with PayOS</button>
</form>
@endsection