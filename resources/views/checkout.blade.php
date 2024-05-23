
@include('layouts.navigation')
<x-app-layout>
    <div class="wrapper">
        <div class="container">
            <form action="{{ route('checkout.process') }}" method="POST">
                @csrf
                <h1>
                    <i class="fas fa-shipping-fast"></i>
                    Shipping Details
                </h1>
                <div class="name">
                    <div>
                        <label for="f-name">First Name</label>
                        <input type="text" name="first_name" required>
                    </div>
                    <div>
                        <label for="l-name">Last Name</label>
                        <input type="text" name="last_name" required>
                    </div>
                </div>
                <div class="street">
                    <label for="address">Street</label>
                    <input type="text" name="address" required>
                </div>
                <div class="address-info">
                    <div>
                        <label for="city">City</label>
                        <input type="text" name="city" required>
                    </div>
                    <div>
                        <label for="state">Region</label>
                        <input type="text" name="state" required>
                    </div>
                    <div>
                        <label for="zip">Zip Code</label>
                        <input type="text" name="zip_code" required>
                    </div>
                </div>
                <h1>
                    <i class="far fa-credit-card"></i> Payment Information
                </h1>
                <div class="cc-num">
                    <label for="card-num">Credit Card No.</label>
                    <input type="text" name="credit_card_no" required>
                </div>
                <div class="cc-info">
                    <div>
                        <label for="expire">Exp</label>
                        <input type="text" name="exp" required>
                    </div>
                    <div>
                        <label for="ccv">CCV</label>
                        <input type="text" name="ccv" required>
                    </div>
                </div>
                <div class="btns">
                    <button type="submit">Pay ${{$totalPrice}}</button>
                    <a href="{{ route('carts.index') }}" class="button">Back to cart</a>
                </div>
            </form>
        </div>
    </div>

    <style>
        .wrapper {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            background: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .container {
            display: flex;
            flex-direction: column;
        }
        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }
        h1 i {
            margin-right: 10px;
        }
        .name, .address-info, .cc-info {
            display: flex;
            justify-content: space-between;
        }
        .name div, .address-info div, .cc-info div {
            flex: 1;
            margin-right: 10px;
        }
        .name div:last-child, .address-info div:last-child, .cc-info div:last-child {
            margin-right: 0;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .btns {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .btns button, .btns .button {
            padding: 10px 20px;
            border: none;
            background: #007bff;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
        }
        .btns .button {
            background: #6c757d;
        }
    </style>
</x-app-layout>
@include('layouts.footer')