@extends('layout.master')
@section('title','Home page')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/homepage.css') }}">
@stop
@section('content')
<div class="introduction">
        <div class="neoslideshow" style="width: 100%; height: 100%">
            <img src="{{ asset('images/img00.jpg') }}" width="100%" height="100%" />
            <img src="{{ asset('images/img01.jpg') }}" width="100%" height="100%" />
            <img src="{{ asset('images/img02.jpg') }}" width="100%" height="100%" />
            <img src="{{ asset('images/img03.jpg') }}" width="100%" height="100%" />
            <img src="{{ asset('images/img04.jpg') }}" width="100%" height="100%" />
        </div>
        </div>
        <div class="outclientsay">
            <div class="row">
                <div class="container">
                    <div class="col-md-12">
                        <p class="pull-left"><i class="fa fa-quote-left"></i></p>
                        <br>
                        <p>To be fair, when we were looking for an ODC, we did look at a few others. But all of the other ODCs waved their ISO and CMMI certifications at us as proof of their abilities and frankly, all that proves to me is that they are not agile enough for our industry ([an industry name]). We chose Enclave on the basis of best-fit and their ability to work to our methodologies. It turned out to be a decision we do not regret for one minute.</p>
                        <p class="pull-right"><i class="fa fa-quote-right"></i></p>
                        <br>
                        <p class="pull-right">Great Work, [Client] Director of Development, Australia</p>
                    </div>
                </div>
            </div>
        </div>
@stop
@section('script')
<script type="text/javascript">
            $(function() {
                $('.neoslideshow img:gt(0)').hide();
                setInterval(function() {
                        $('.neoslideshow :first-child').fadeOut()
                            .next('img').fadeIn()
                            .end().appendTo('.neoslideshow');
                    },
                    4000);
            });
        </script>
@stop