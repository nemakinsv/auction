

@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Аукцион, продается: {{$lot->name}}</div>
                    <div class="card-body">
                        <div id="caption"></div>
                        <br>
                        <form method="post" action = '{{ route('auction.offer', ['id' => $lot->id]) }}'>
                            @csrf
                            <input type = "text" name="newPrice" >
                            <br>
                            <br>
                            <input type="submit" value="Предложить">
                        </form>
                    </div>
                    <img class="card-img-bottom" src="{{env('APP_URL').str_replace("public", "storage", $lot->src)}}"
                                                    alt="{{$lot->src}}">
                    <!-- Текстовый контент -->


                </div>
            </div>
        </div>
    </div>


        <script>
            window.setInterval(refresh, 2000);


            function refresh() {
                axios({
                    url: `{{ route('auction.refresh', ['id' => $lot->id]) }}`,
                    method: 'GET',
                    responseType: 'json'
                }).then((response) => {
                    if (response.data.refreshString) {
                        document.getElementById("caption").innerHTML= response.data.refreshString;
                        //alert(response.data.refreshString);
                    }
                }).catch(function (err) {
                    alert('error');
                    console.log(err);
                });
            }
        </script>
@endsection

