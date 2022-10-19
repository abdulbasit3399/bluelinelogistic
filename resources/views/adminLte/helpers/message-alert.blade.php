@if(session()->has('message_alert'))

    <script>

        Toast.fire({
            icon: 'success',
            title: '{{ session("message_alert") }}'
        })

    </script>
@elseif(session()->has('error_message_alert'))
    <script>

        Toast.fire({
            icon: 'error',
            title: '{{ session("error_message_alert") }}'
        })

    </script>
@endif