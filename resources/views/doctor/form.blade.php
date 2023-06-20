@extends('layouts.app')

@section('content')


<script src="https://js.braintreegateway.com/web/dropin/1.30.1/js/dropin.min.js"></script>
<script>

    var form = document.querySelector('form');

    braintree.dropin.create({
        authorization: "{{ $test->clientToken()->generate() }}",
        container: '#dropin-container'

    }, function (createErr, instance) {
        if (createErr) {
            console.log('Errore creazione Drop-in:', createErr);
            return;
        }
        form.addEventListener('submit', function (event) {
            event.preventDefault();

            instance.requestPaymentMethod(function (err, payload) {
                if (err) {
                    console.log('Errore ottenimento pagamento:', err);
                    return;
                }

                // Aggiungi il nonce al form e invia la richiesta di pagamento
                document.querySelector('#payment_method_nonce').value = payload.nonce;
                form.submit();
            });
        });
    });

</script>


  {{--   <form method="post" action="/payment/process">
       
    </form> --}}
        
    <form action='/payment/process' method="POST">
        @csrf
        <div id="dropin-container"></div>
        <button type="submit" class="btn btn-primary">Effettua il pagamento</button>
    </form>

@endsection
