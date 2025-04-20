<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Checkout</div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('payment.process') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="amount" class="form-label">Amount (VND)</label>
                                <input type="number" 
                                       class="form-control" 
                                       id="amount" 
                                       name="amount" 
                                       required 
                                       min="1000">
                            </div>
                            <button type="submit" class="btn btn-primary">Pay with PayOS</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>