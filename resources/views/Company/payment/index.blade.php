@extends('../layouts.company')

@section('style-area-stripe')
    <link rel="stylesheet" href="{{asset('css/stripe.css')}}">
@endsection

@section('content')
<section>
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
  </section>
    
@endsection

@section('script-area-stripe')
    <script type="text/javascript">
        // Create an instance of the Stripe object with your publishable API key
        var stripe = Stripe("pk_test_51IOcIuCSm0hMqsgEOGCdSantCG0TFIrv8AGsBRSFieHgPTILNFDwzWfw9U6HgvXYRqmLTkkV0MaEHPUrddzMukO600kAzZnHOR");
        var checkoutButton = document.getElementById("checkout-button");

        checkoutButton.addEventListener("click", function () {
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
@endsection