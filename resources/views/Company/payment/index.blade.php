@extends('../layouts.company')

@section('style-area-stripe')
    {{-- <link rel="stylesheet" href="{{asset('css/stripe.css')}}"> --}}

    <style>
    </style>

@endsection

@push('script-top')
    <script src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch"></script>
    <script src="https://js.stripe.com/v3/"></script>
@endpush

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 d-flex justify-content-center">

            <div class="card" style="width: 18rem;">
                {{-- <img src="..." class="card-img-top" alt="...">
                 --}}
                 <img
                src="https://i.imgur.com/EHyR2nP.png"
                alt="The cover of Stubborn Attachments"
                />
                <div class="card-body">
                    <h5 class="card-title w-100 text-center">NOM-035</h5>
                    <p class="card-text">Para continuar es necesario pagar los derechos de uso de la plataforma NOM-035</p>
                    {{-- <a href="#" class="btn btn-primary">Go somewhere</a>
                     --}}
                    <button type="button" id="checkout-button" class="btn btn-primary w-100">
                        <span id="pagar">Pagar</span>
                        <div id="loading" class="spinner-border text-light d-none" style="width: 1.8rem; height: 1.8rem;" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </button>
                </div>
            </div>

            
        </div>
    </div>
</div>

{{-- <section>
    <div class="product">
      <img
        src="https://i.imgur.com/EHyR2nP.png"
        alt="The cover of Stubborn Attachments"
      />
      <div class="description">
        <h3>Stubborn Attachments</h3>
        <h5>$20.00</h5>
      </div>
    </div>
    <button type="button" id="checkout-button">Checkout</button>
</section> --}}
    
@endsection

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script type="text/javascript">

        let pagar = document.getElementById('pagar')
        let loading = document.getElementById('loading')



        // Create an instance of the Stripe object with your publishable API key
        var stripe = Stripe("pk_test_51IOcIuCSm0hMqsgEOGCdSantCG0TFIrv8AGsBRSFieHgPTILNFDwzWfw9U6HgvXYRqmLTkkV0MaEHPUrddzMukO600kAzZnHOR");
        var checkoutButton = document.getElementById("checkout-button");

        checkoutButton.addEventListener("click", function () {
            
            pagar.classList.toggle('d-none')
            loading.classList.toggle('d-none')

          fetch("/api/empresa/payment/create-checkout-session", {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
              "Accept": "application/json",
              "X-Requested-With": "XMLHttpRequest",
              "X-CSRF-Token": window.codigo
            },
          })
            .then(function (response) {
                console.log('MACHINIMA')
                console.log(response)
              return response.json();
            })
            .then(function (session) {
                // console.log(TGN)
              return stripe.redirectToCheckout({ sessionId: session.id });
            })
            .then(function (result) {
              // If redirectToCheckout fails due to a browser or network
              // error, you should display the localized error message to your
              // customer using error.message.
              if (result.error) {
                alert(result.error.message);
              }
            })
            .catch(function (error) {
              console.error("Error:", error);
            });

          // axios.get('/api/empresa/payment/create-checkout-session')
          // .then(function (response) {
          //   // handle success
          //   console.log(response.data);
          // })
          // .catch(function (error) {
          //   // handle error
          //   console.log(error);
          // })
          // .then(function () {
          //   // always executed
          // });
        });
    </script>
@endpush