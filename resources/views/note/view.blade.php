@extends('layout.master')
@section('title','Note')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/note.css') }}">
@stop
<style>
    
.content-box-large {
    margin-bottom: 20px;
    height: 165px;
    width: 220px;
    background: url("{{ asset('images/pin.png') }}"), url("{{ asset('images/note2.png') }}") ;
    background-size: 50px 40px ,250px 165px;
    background-repeat: no-repeat, no-repeat;
    background-position: right top, left top;
    padding: 10px;
    background-color: #fff;
    border-radius: 5px;
    color: white;
    margin-left: 40px;
    margin-right: 0px;
}

.content-box-large h3 {
    text-align: center;
    vertical-align: middle;
}

.new {
    border-radius: 15px;
    background-color: orange;
    color: white;
    position: fixed;
    top: 150px;
    right: 15px;
}

.btn-circle {
    width: 30px;
    height: 30px;
    text-align: center;
    padding: 6px 0;
    font-size: 12px;
    line-height: 1.428571429;
    border-radius: 15px;
    -webkit-box-shadow: 3px 9px 23px -6px rgba(222, 182, 102, 1);
    -moz-box-shadow: 3px 9px 23px -6px rgba(222, 182, 102, 1);
    box-shadow: 3px 9px 23px -6px rgba(222, 182, 102, 1);
}

.list {
    width: 200px;
}

.add {
    bottom: 50px;
    right: 10px;
    z-index: 1001;
    margin-right: 70px;
}

.title-note {
    margin-top: 10px;
    margin-left: 20px;
    word-wrap: break-word;
    width: 98%;
    text-overflow: ellipsis;
    overflow: hidden;
    white-space: nowrap;
    color: #2c3e50;
    font-family: "Purisa";
    font-size: 15;
}

.time-note {
    position: absolute;
    bottom: 6px;
    right: 55px;
    color: #2c3e50;
    font-family: "Purisa";
    margin-bottom: 45px;
}

.options {
    height: 20px;
    margin-left: 20px;
    margin-right: 20px;
}

.options h4 {
    margin-left: 15px;
    float: left;
}

.options img {
    width: 50px;
    height: 50px;
}
</style>
@section('content')
    <div id="img-title">
        <p>Note</p>
    </div>
    @if (Session::has('flat'))
        <div class="alert alert-success" role="alert">{{Session('flat')}}</div>
    @endif
    <hr>
    <div class="col-md-3 projects">
        <div class="content-box-large" onclick="$('#create-note').trigger('click');" style="">
            <p style="font-size: 48px;color: #2c3e50; margin-left: 30px">...</p>
        </div>
    </div>

    <div class="row folder">

        @foreach ($list_idNote as $idnote)
        <div class="col-md-3 projects">
            <div class="content-box-large" onclick="$('#open-modal{{ $idnote->idNote }}').trigger('click');" style="">
                <p class="title-note"><b>{{$idnote->N_Title}}</b></p>
                <p class="time-note"><i>{{$idnote->N_DateCreate}}</i></p>
            </div>

            <!-- View note -->
            <a id="open-modal{{ $idnote->idNote }}" data-toggle="modal" href='#view-id{{ $idnote->idNote }}'></a>
            <div class="modal fade" id="view-id{{ $idnote->idNote }}">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ url('/view-note') }}" method="POST" accept-charset="utf-8" id="form-view">
                        {{csrf_field()}}
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">Note</h4>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="idno" value="{{ $idnote->idNote }}">
                                <label for="">Title Note:</label>
                                <input type="text" name="edit_title" value="{{ $idnote->N_Title }}" style="width: 300px" disabled="true">
                                <br>
                                <label for="">Content of Note:</label>
                                <br>
                                <textarea name="edit_content" rows="10" cols="55" disabled="true">{{ $idnote->N_Content }}</textarea>                      
                            </div>
                            <div class="modal-footer">
                                <div class="submit" style="float:right">
                                    <input id="edit-btn" style="width:80px" data-toggle="modal" href='#edit-id{{ $idnote->idNote }}' class="btn btn-default" value="Edit">
                                    <input id="delete-btn" style="width:80px" data-toggle="modal" href='#delete-id{{ $idnote->idNote }}' class="btn btn-default" value="Delete">
                                    <a class="btn btn-default" data-dismiss="modal">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>



            <!-- Edit note -->
           <!--  <a id="open-modal" data-toggle="modal" href='#edit-id{{ $idnote->idNote }}'></a> -->
            <div class="modal fade" id="edit-id{{ $idnote->idNote }}">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ url('/edit-note') }}" method="POST" accept-charset="utf-8" id="form-edit">
                        {{csrf_field()}}
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">Edit Note</h4>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="idno" value="{{ $idnote->idNote }}">
                                <label for="">Title Note:</label>
                                <input type="text" name="edit_title" value="{{ $idnote->N_Title }}" style="width: 300px">
                                <br>
                                <label for="">Content of Note:</label>
                                <br>
                                <textarea name="edit_content" rows="10" cols="55">{{ $idnote->N_Content }}</textarea>                      
                            </div>
                            <div class="modal-footer">
                                <div class="submit" style="float:right">
                                    <input type="submit" class="btn btn-primary" value="Submit">
                                    <a data-dismiss="modal" class="btn btn-default">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Delete note -->
            <div class="modal fade" id="delete-id{{ $idnote->idNote }}">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ url('/delete-note') }}" method="POST" accept-charset="utf-8">
                            {{csrf_field()}}
                            <div class="modal-body">
                                <h4 class="modal-title">You really want to delete it, don't you? Are you sure?</h4>
                                <input type="hidden" name="idno" value="{{ $idnote->idNote }}">
                            </div>
                            <div class="modal-footer">
                                <div class="submit" style="float:right">
                                    <input type="submit" class="btn btn-primary" value="Yes">
                                    <a href="/note" class="btn btn-default">No, thanks</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>


    <!-- Create note -->
    <a id="create-note" data-toggle="modal" href='#create-id'></a>
    <div class="modal fade" id="create-id">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Create new Note</h4>
                </div>
                <div class="modal-body">
                    <form id="form-create" action="{{ url('/create-note') }}" method="POST" accept-charset="utf-8">
                    {{csrf_field()}}
                        <label for="">Title Note:</label>
                        <input type="text" name="titleNote" value="" style="width: 300px" placeholder="Enter Note's Title">
                        <br>
                        <label for="">Content of Note:</label>
                        <br>
                        <textarea name="contentNote" rows="10" cols="55" placeholder="Enter content of note"></textarea>
                        <div class="create-note-button modal-footer">
                            <input type="submit" name="button" id="save-button" class="btn btn-primary" value="Create">
                            <a data-dismiss="modal" class="btn btn-default">Cancel</a>
                        </div>
                     </form>
                </div>               
            </div>
        </div>
    </div>

    <!-- Notification when finish to create note! -->
    <div>       
        @if(Session::has('msg1'))            
            <a data-toggle="modal" id="msg1" href='#msg1-id'></a>
            <div class="modal fade" id="msg1-id">
                <div class="modal-dialog">
                    <div id="my-modal" class="modal-content">
                        <div class="modal-body">
                                {{Session::get('msg1')}}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
                        </div>
                    </div>
                </div>
            </div>
         @elseif (Session::has('msg2'))
            <a data-toggle="modal" id="msg2" href='#msg2-id1'></a>
            <div class="modal fade" id="msg2-id1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                                {{Session::get('msg2')}}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal" data-toggle="modal" href='#send-message'>OK</button>
                        </div>
                    </div>
                </div>
            </div>
         @endif
    </div>



       <!--  Notification when finish edit note -->
            <div>       
                @if(Session::has('msg3'))            
                    <a data-toggle="modal" id="msg3" href='#msg3-id'></a>
                    <div class="modal fade" id="msg3-id">
                        <div class="modal-dialog">
                            <div id="my-modal" class="modal-content">
                                <div class="modal-body">
                                        {{Session::get('msg3')}}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
                                </div>
                            </div>
                        </div>
                    </div>
                 @elseif (Session::has('msg4'))
                    <a data-toggle="modal" id="msg4" href='#msg4-id1'></a>
                    <div class="modal fade" id="msg4-id1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                        {{Session::get('msg4')}}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal" data-toggle="modal" href='#send-message'>OK</button>
                                </div>
                            </div>
                        </div>
                    </div>
                 @endif
            </div>
    
   

@stop
@section('script')
   <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>
  
    <script  type="text/javascript" charset="utf-8">
        $(document).on('click', "#edit-btn",function(){
            $(this).parent().parent().parent().parent().parent().parent().find(".close").click();
        });        
    </script>
    
    <script  type="text/javascript" charset="utf-8">
        $(document).on('click', "#delete-btn",function(){
            $(this).parent().parent().parent().parent().parent().parent().find(".close").click();
        });        
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.4/raphael-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
  
    <!-- Bootstrap JavaScript -->
    <script type="text/javascript" src="{{ asset('js/jquery-validate/jquery.validate.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery-validate/additional-methods.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.4/raphael-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script type="text/javascript">
        $('#form-create').validate({
            rules: {
                titleNote: {
                    required:true,
                    minlength:4
                },
                contentNote: {
                    required:true,
                    minlength:4
                }
            },
            messages: {
                titleNote: {
                    required: "Enter title of your message.",
                    minlength: "Title should has length more than 4 characters."
                },
                contentNote: {
                    required: "Enter content of your message.",
                    minlength: "Content should has length more than 4 characters."
                }
            }
        });
    </script>

    <script>
        jQuery(function(){
           jQuery('#msg1').click();
        });
         jQuery(function(){
           jQuery('#msg2').click();
        });
        $('#msg1-id').on('show.bs.modal', function (e) {
            $('body').addClass('test');
        });
        $('#msg2-id1').on('show.bs.modal', function (e) {
            $('body').addClass('test');
        });
        $('#form-create').on('show.bs.modal', function (e) {
            $('body').addClass('test');
        });
    </script>

    <script type="text/javascript">
        $('#form-edit').validate({
            rules: {
                edit_title: {
                    required: true,
                    minlength: 4
                },
                edit_content: {
                    required: true,
                    minlength: 4
                }
            },
            messages: {
                edit_title: {
                    required: "Enter title of your message.",
                    minlength: "Title should has length more than 4 characters."
                },
                edit_content: {
                    required: "Enter content of your message.",
                    minlength: "Content should has length more than 4 characters."
                }
            }
        });
    </script>

    <script>
            jQuery(function(){
               jQuery('#msg3').click();
            });
             jQuery(function(){
               jQuery('#msg4').click();
            });
        $('#msg3-id').on('show.bs.modal', function (e) {
            $('body').addClass('test');
        });
        $('#msg4-id1').on('show.bs.modal', function (e) {
            $('body').addClass('test');
        });
        $('#form-edit').on('show.bs.modal', function (e) {
            $('body').addClass('test');
        });
    </script>   

@stop
