<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Novecology Chat Bot</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('chatbot_assets/css/style.min.css') }}">
    <style>
        .chat__card--agent .chat__message::before{
            background-image: url({{ asset('frontend_assets/images/women-user.png') }});
        }
    </style>
</head>
<body>
    <div class="chat">
        <div class="chat__body">
            <div class="chat__card chat__card--agent">
                <div class="chat__message-wrapper" style="--index: 0">
                    <div class="chat__message">Votre logement se trouve t - il en Ile-De-France ?</div>
                </div>
                <div class="chat__message-wrapper" style="--index: 1">
                    <label class="option-btn" role="button">
                        <input class="option-btn__input" type="radio" data-response="1" value="Oui" data-toggle="message">
                        <span class="option-btn__text">Oui</span>
                    </label>
                    <label class="option-btn" role="button">
                        <input class="option-btn__input" type="radio" data-response="1" value="Non" data-toggle="message">
                        <span class="option-btn__text">Non</span>
                    </label>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function () {
            let selected_response = {};
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(".option-btn__input").each(function(index, item){
                item.checked = false;
            });

            $(document).on('change', '[data-toggle="message"]', function(){
                const currentParentElement  = $(this).closest(".chat__card");
                let response                = $(this).data('response');
                let value                   = $(this).val();
                selected_response[response] = value;
                $.ajax({
                    type : "POST",
                    url  : "{{ route('chatbot.option.click') }}",
                    data : {response, value, selected_response},
                    success : data => {
                        if(data.success){
                            currentParentElement.after(data.success);
                            $(this).closest(".chat__message-wrapper").remove();
                        }
                        if(data.error){
                            setTimeout(function(){
                                window.location.href = '/';
                            },3000)
                        }
                    }
                });
            });

            $(document).on('submit', '#chatBotSubmitForm', function(){
                let first_name = $("#botFirstName").val();
                let last_name = $("#botLastName").val();
                let phone = $("#botTelephone").val();
                let email = $("#botEmail").val();

                $.ajax({
                    type : "POST",
                    url  : "{{ route('chatbot.data.store') }}",
                    data : {first_name, last_name, phone, email, selected_response},
                    success : data => {
                        setTimeout(function(){
                            window.location.href = '/';
                        },2000)
                    }
                });
            });
        })
    </script>
</body>
</html>
