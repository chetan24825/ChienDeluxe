@extends('fronts.layouts.app')
@section('content')
<script src="https://sdk.cashfree.com/js/v3/cashfree.js"></script>
<button type="button" id="renderBtn" class="btn btn-base border-radius-5 pe-5 ps-5">
    Pay Now
</button>
@endsection
@section('script')
<script>
    const cashfree = Cashfree({
        mode: "sandbox" //or production
    });
     window.onload = function() {
      document.getElementById('renderBtn').click();
    };

    document.getElementById('renderBtn').addEventListener('click', function() {
        cashfree.checkout({
            paymentSessionId: "{{$session_id}}",
        });
    });
</script>
@endsection