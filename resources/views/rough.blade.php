<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        .tab-buttons{
        display: flex;
        justify-content: start;
        align-items: center;
        }

        .tab-buttons .tab-button{
            padding: 10px 10px;
            background-color: gray;
            color: black;
            margin-right: 5px;
        }

        .tab-buttons .tab-button-active{
            padding: 10px 10px;
            background-color: black;
            color: white;
            margin-right: 5px;
        }

        .hidden{
            display: none;
        }
    </style>
</head>
<body>
    <div class="tab-buttons">
        <button id="quote_button" class="tab-button-active" onclick="showTab('quote_tab')">Quote</button>
        <button id="order_button" class="tab-button" onclick="showTab('order_tab')">Order</button>
        <button id="artwork_button" class="tab-button" onclick="showTab('artwork_tab')">Artwork</button>
        <button class="tab-button">Proof</button>
        <button class="tab-button">Order Processing</button>
        <button class="tab-button">Out For Delivery</button>
        <button class="tab-button">Order Fullfilled</button>
    </div>

    <div class="tab-contents">
        <div id="quote_tab" class="">
            Quote
        </div>
        <div id="order_tab" class="hidden">
            Order
        </div>
        <div id="artwork_tab" class="hidden">
            Artwork
        </div>
    </div>


    <script>
        function showTab(tab_name){

            if(tab_name == 'quote_tab'){
                let element = document.getElementById('quote_tab')
                let button = document.getElementById('quote_button')

                if(element.classList.contains('hidden')){
                    element.classList.remove('hidden')
                }

                if(button.classList.contains('tab-button-active')){

                }
                else{
                    button.classList.add('tab-button-active')
                }

                if(button.classList.contains('tab-button')){
                    button.classList.remove('tab-button')
                }
                else{

                }
            }
            else{
                let element = document.getElementById('quote_tab');
                let button = document.getElementById('quote_button')

                if(element.classList.contains('hidden')){
                }
                else{
                    element.classList.add('hidden')
                }

                if(button.classList.contains('tab-button-active')){
                    button.classList.remove('tab-button-active')
                }

                if(button.classList.contains('tab-button')){

                }
                else{
                    button.classList.add('tab-button')
                }
            }

            if(tab_name == 'order_tab'){
                let element = document.getElementById('order_tab')
                let button = document.getElementById('order_button')

                if(element.classList.contains('hidden')){
                    element.classList.remove('hidden')
                }

                if(button.classList.contains('tab-button-active')){

                }
                else{
                    button.classList.add('tab-button-active')
                }

                if(button.classList.contains('tab-button')){
                    button.classList.remove('tab-button')
                }
                else{

                }
            }
            else{
                let element = document.getElementById('order_tab');
                let button = document.getElementById('order_button')

                if(element.classList.contains('hidden')){
                }
                else{
                    element.classList.add('hidden')
                }

                if(button.classList.contains('tab-button-active')){
                    button.classList.remove('tab-button-active')
                }

                if(button.classList.contains('tab-button')){

                }
                else{
                    button.classList.add('tab-button')
                }
            }

            if(tab_name == 'artwork_tab'){
                let element = document.getElementById('artwork_tab')
                let button = document.getElementById('artwork_button')

                if(element.classList.contains('hidden')){
                    element.classList.remove('hidden')
                }

                if(button.classList.contains('tab-button-active')){

                }
                else{
                    button.classList.add('tab-button-active')
                }

                if(button.classList.contains('tab-button')){
                    button.classList.remove('tab-button')
                }
                else{

                }
            }
            else{
                let element = document.getElementById('artwork_tab');
                let button = document.getElementById('artwork_button')

                if(element.classList.contains('hidden')){
                }
                else{
                    element.classList.add('hidden')
                }

                if(button.classList.contains('tab-button-active')){
                    button.classList.remove('tab-button-active')
                }

                if(button.classList.contains('tab-button')){

                }
                else{
                    button.classList.add('tab-button')
                }
            }
        }
    </script>
</body>
</html>
