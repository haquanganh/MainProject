@extends('layout.admin')
@section('title','Edit Personal')
@section('name','Edit Personal')
@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/edit_personal.css') }}">
@stop
@section('content')
{!!Form::open(array('route'=>array('admin.personal-information.update',$employee['idEmployee']),'method'=>'PUT','enctype'=> 'multipart/form-data','files' => true))!!}
<div id="regis-body-right">
			<div id="regis-body-right-left">
					<div class="regis-info">
						<div class="regis-info-left">
							<label>Email</label>
							<span style="color: red;">*</span>
						</div>
						<div class="regis-info-right">
							<input type="email" placeholder="Email" name="in_Email" value="{{old('in_Email',isset($employee) ? $employee['E_Email'] : null)}}">
						</div>
					</div>
					<div class="regis-info">
						<div class="regis-info-left">
							<label>English name</label>
							<span style="color: red;">*</span>
						</div>
						<div class="regis-info-right">
							<input type="text" placeholder="English name" name="in_eName" value="{{old('in_eName',isset($employee) ? $employee['E_EngName'] : null)}}">
						</div>
						<div class="error" style="clear: both;float: right; color: red;">
							@if ($errors->has('in_eName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('in_eName') }}</strong>
                                    </span>
                                @endif
						</div>
					</div>
					<div class="regis-info">
						<div class="regis-info-left">
							<label>Full name</label>
							<span style="color: red;">*</span>
						</div>
						<div class="regis-info-right">
							<input type="text" placeholder="Full name" name="in_FullName" value="{{old('in_eName',isset($employee) ? $employee['E_Name'] : null)}}">
						</div>
					</div>
					<div class="regis-info">
						<div class="regis-info-left">
							<label>Address</label>
							<span style="color: red;">*</span>
						</div>
						<div class="regis-info-right">
							<input type="text" placeholder="Address" name="in_Address" value="{{old('in_Address',isset($employee) ? $employee['E_Address'] : null)}}"></input>
						</div>
					</div>
					<div class="regis-info">
						<div class="regis-info-left">
							<label>Phone number</label>
							<span style="color: red;">*</span>
						</div>
						<div class="regis-info-right">
							<input type="text" placeholder="Phone number" name="in_Phone" value="{{old('in_Phone',isset($employee) ? $employee['E_Phone'] : null)}}">
						</div>
					</div>
					<div class="regis-info">
						<div class="regis-info-left">
							<label>Skype addres</label>
							<span style="color: red;">*</span>
						</div>
						<div class="regis-info-right">
							<input type="text" placeholder="Skype address" name="in_Skype" value="{{old('in_Skype',isset($employee) ? $employee['E_Skype'] : null)}}">
						</div>
					</div>
					<div class="regis-info">
						<div class="regis-info-left">
							<label>Role</label>
							<span style="color: red;">*</span>
						</div>
						<?php
                        	$id_Role = App\User::find($employee->idAccount)->idRole;
                        	$list_role_name = App\Role::all();
                   		 ?>
						<div class="regis-info-right">
							<select name="Role">
									<option value="Administrator" {{$id_Role ==1 ? 'selected' : null}}>Administrator</option>
	                                <option value="Manager" {{$id_Role ==2 ? 'selected' : null}}>Manager</option>
	                                <option value="Leader" {{$id_Role ==3 ? 'selected' : null}}>Leader</option>
	                                <option value="Client" {{$id_Role ==4 ? 'selected' : null}}>Client</option>
	                                <option value="Member" {{$id_Role ==5 ? 'selected' : null}}>Member</option>
                            </select>
						</div>
					</div>
					<div class="regis-info">
						<div class="regis-info-left">
							<label>Cost/hour</label>
							<span style="color: red;">*</span>
						</div>
						<div class="regis-info-right">
							<input type="number" placeholder="Cost/hour" name="in_CostHour" value="{{old('in_CostHour',isset($employee) ? $employee['E_Cost_Hour'] : null)}}">
						</div>
					</div>
			</div><!--regis-body-right-left-->
			<div id="regis-body-right-right">
				<div id="regis-body-right-right-top">
						<img src="{{ asset('images/personal_images/') }}/{{$employee->E_Avatar}}">
						<div class="box">
                                        <input type="file" name="in_img" id="img" class="inputfile inputfile-2" data-multiple-caption="{count} files selected" multiple />
                                        <label for="img" class="label_img">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
                                                <path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z" />
                                            </svg> <span>Choose a file&hellip;</span></label>
                                    </div>
				</div>
				<div id="regis-body-right-right-bot">
					<table class="table">
	                    <thead>
	                        <tr>
	                            <th>Skill</th>
	                            <th>Year of experience</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                    	@foreach ($employee->Skill()->get() as $skill)
	                    	<tr>
	                    		<td>{{$skill->Skill}}</td>
	                    		<td>
	                    			<input name="{{$skill->Skill}}" type="number" placeholder=" years" value="{{$skill->pivot->S_Rate}}">
								</td>
	                    	</tr>
	                    	@endforeach
	                    </tbody>
	                </table>
				</div>
			</div><!--regis-body-right-right-->
			<div class="clear"></div>
			<div id="regis-button">
				<a href="#modalupdate" data-toggle="modal" class="btn btn-primary" style="width: 80px;">Update</a>
				<a href="#modalcancel" data-toggle="modal" class="btn btn-primary" style="margin-left: 15px;width: 80px;">Cancel</a>
				<div class="modal fade" id="modalupdate">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title">Warming</h4>
							</div>
							<div class="modal-body">
							Do you really want to update?
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								<input type="submit" class="btn btn-primary" value="Confirm">
							</div>
						</div>
					</div>
				</div>
				<div class="modal fade" id="modalcancel">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title">Warming</h4>
							</div>
							<div class="modal-body">
							Do you really want to cancel?
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								<a href="{{ route('admin.personal-information.index') }}" class="btn btn-primary">Submit</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div><!--regis-body-right-->
		{!! Form::close()!!}
@stop
@section('script')
<script src="{{ asset('js/custom-file-input.js') }}"></script>
@stop