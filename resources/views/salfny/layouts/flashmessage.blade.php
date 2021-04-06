@if(Session::has('flash_message'))
    <script>
        let timerInterval
        Swal.fire({
            title: "<h2 class='text-info'>{{Session::get('flash_message')}}.</h2>",
            html: "<h4><i class='fa fa-check-circle fa-2x text-success'></i></h4>",
            timer: 2000,
            timerProgressBar: true,
            onBeforeOpen: () => {
                Swal.showLoading()
                timerInterval = setInterval(() => {
                    Swal.getContent().querySelector('b')
                        .textContent = Swal.getTimerLeft()
                }, 100)
            }
        })
    </script>
@endif
