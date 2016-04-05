@extends('layout.master')
@section('title','Home page')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/homepage.css') }}">
@stop
@section('content')
            <div class="introduction">
                <div class="jumbotron">
                    <h3>BUSINESS INFORMATION MANAGEMENT SYSTEM</h3>
                    <p>Reliable Engineering</p>
                </div>
            </div>
            <div id="ourcompany" style="padding:131.5px 0;">
                <div class="row" style="">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-5" style="">
                        <img src="{{ asset('images/ourcompany.png') }}" alt="" style="width:378px;height:372px" class="img-responsive img-circle center-block">
                    </div>
                    <div class="col-sm-5" style="padding-top:10px;">
                        <p style="font-size:33px;font-weight:bold;max-width:351px;margin:auto">OUR COMPANY</p>
                        <p style="font-size:17px; text-align:justify;max-width:351px;margin:auto">We are Enclave, a company of and by software engineering professionals. We invest in our people, our facilities, and our capabilities. We provide Offshore Development Centers (ODC) for information technology outsourcing (ITO) and Information Technology Intensive Operations (ITIO). We also provide technical and management support for our assigned personnel and teams. We require and provide continuing education and professional development.</p>
                    </div>
                    <div class="col-sm-1"></div>
                </div>
            </div>
            <div class="ourmodel" style="padding:65px 0;">
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-5 col-sm-push-5" style="">
                        <img src="{{ asset('images/ourmodel.png') }}" alt="" style="width:378px;height:320px" class="img-responsive center-block">
                    </div>
                    <div class="col-sm-5 col-sm-pull-5 text-center" style="padding-top:10px;">
                        <p id="title-organization">Enclave's Engineering Organizational Model</p>
                    </div>
                    <div class="col-sm-1"></div>
                </div>
            </div>
@stop
@section('script')
@stop