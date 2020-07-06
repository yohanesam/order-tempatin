@extends('layouts.main')

@section('content')
                                
                                <!-- page specific plugin styles -->
                                <link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.custom.min.css') }}" />
                                <link rel="stylesheet" href="{{ asset('assets/css/chosen.min.css') }}" />
                                <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datepicker3.min.css') }}" />
                                <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-timepicker.min.css') }}" />
                                <link rel="stylesheet" href="{{ asset('assets/css/daterangepicker.min.css') }}" />
                                <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}" />
                                <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-colorpicker.min.css') }}" />
								<link rel="stylesheet" href="{{ asset('assets/css/bootstrap-multiselect.min.css') }}" />
								<link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}" />

                                @if (\Session::has('success'))
                                    <div class="alert alert-success">
                                    <p>{{ \Session::get('success') }}</p>
                                    </div><br/>
								@endif
								<div class="row">
                                    <div class="col-xs-12">
                                        <!-- PAGE CONTENT BEGINS -->
                                        <form class="form-horizontal" role="form" action="{{route('create.building')}}" method="post" enctype="multipart/form-data">
											@csrf
											<div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Foto Bangunan </label>

                                                <div class="col-sm-5">
													<input multiple type="file" id="id-input-foto_bangunan" name="foto_bangunan[]" />
												</div>
												<!-- <script>
												</script> -->
												<script>
													$(document).ready(function(){
														$('#id-input-foto_bangunan').ace_file_input({
															style:'well',
															btn_choose:'Taruh file atau Klik disini untuk Upload Foto Bangunan',
															btn_change:null,
															no_icon:'ace-icon fa fa-cloud-upload',
															droppable:true,
															thumbnail:'large'
														})
														@if(Request::is('merchant/building/edit/'.request()->route('id')))
														var data ='{{$building->foto_bangunan}}';
														var img = JSON.parse(data.replace(/&quot;/g,'"'));
														for(i = 0; i < img.length; i++){
															var p =img[i];
															img[i]={};
															img[i].type='image'; 
															img[i].name= 'slider-'+(i+1);
															img[i].path='{{asset("foto_bangunan")}}/'+p;
															// img[i]='{{asset("foto_bangunan")}}/'+img[i];
														};
														// alert(JSON. stringify(img));
														$('#id-input-foto_bangunan')
														.ace_file_input('show_file_list',img);
														
														// $('#id-input-foto_bangunan')
														// .ace_file_input('show_file_list', [
														// 	{type: 'image', name: 'name of image', path:img[0]}
														// ]);

														$('form').removeAttr('action');
														$('form').attr('action', '{{route("up.building",$building->id_building)}}');
														$('#form-field-nama').val('{{$building->nama_bangunan}}');
														$('#form-field-jml_lantai').val('{{$building->jumlah_lantai}}');
														$('#editor1').html(@json($building->deskripsi));
														$('#form-field-alamat').val('{{$building->alamat}}');
														$.ajax({
															type : 'GET',
															url : '{{url("api/kota")}}/'+'{{$building->provinsi}}',
															success: function (data) {
																
																//jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
																$("#form-field-kota").html(data);
																
																$('#form-field-kota').trigger("chosen:updated");
															}
														});
														var des='{{$building->building_type_id}}';
														$('#form-field-kota').val('{{$building->kota}}');
														$('#form-field-kota').trigger("chosen:updated");
														$('#form-field-provinsi').val('{{$building->provinsi}}');
														$('#form-field-provinsi').trigger("chosen:updated");
														$('#form-field-status').val('{{$building->status_tempat}}');
														$('#form-field-kode_pos').val('{{$building->kode_pos}}');
														$('#form-field-tipe').val(des);
														$('#form-field-tipe').trigger("change");
														@endif
													});
												</script>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Nama Bangunan </label>

                                                <div class="col-sm-9">
                                                    <input type="text" name="nama_bangunan" id="form-field-nama" placeholder="" class="col-xs-10 col-sm-5" />
                                                </div>
                                            </div>

											<div class="form-group">
												<label class="control-label col-xs-12 col-sm-3 no-padding-right"> Kategori Bangunan </label>

												<div class="col-xs-12 col-sm-9">
													<select id="form-field-tipe" name="tipe" class="select2" data-placeholder="Click to Choose...">
													@foreach($building_type as $item)	
														<option value="{{$item->id_building_type}}">{{$item->nama_tipe}}</option>
													@endforeach
													</select>
												</div>
											</div>

											<div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Deskripsi Bangunan </label>

                                                <div class="col-sm-8">
													<div class="wysiwyg-editor" id="editor1"></div>
													<textarea class="hidden" id="form-field-desc" name="deskripsi"></textarea>
													<script>
														$(document).ready(function(){
															$('#editor1').bind("DOMSubtreeModified",function() {
																$('#form-field-desc').val($(this).html());
															});
														});
													</script>
                                                </div>
                                            </div>

											<div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Jumlah Lantai </label>

                                                <div class="col-sm-9">
                                                    <input type="text" id="form-field-jml_lantai" name="jumlah_lantai" placeholder="" class="spinbox-input form-control text-center spinner1" />
                                                </div>
											</div>

											<div class="form-group">
												<label class="control-label col-xs-12 col-sm-3 no-padding-right"> Negara </label>

												<div class="col-xs-12 col-sm-9">
													<input class="col-xs-10 col-sm-5" type="text" name="negara" value="Indonesia" id="form-input-readonly" readonly="true">
												</div>
											</div>

											<div class="form-group">
												<label class="control-label col-xs-12 col-sm-3 no-padding-right"> Provinsi </label>

												<div class="col-xs-12 col-sm-4">
													<select class="chosen-select form-control" id="form-field-provinsi" name="provinsi" data-placeholder="Pilih Provinsi..">
														<option value=""></option>
													@foreach($province as $item)	
														<option value="{{$item['province_id']}}">{{$item['province']}}</option>
													@endforeach
													</select>
												</div>
											</div>

											<div class="form-group">
												<label class="control-label col-xs-12 col-sm-3 no-padding-right"> Kota </label>

												<div class="col-xs-12 col-sm-4">
													<select class="chosen-select form-control" id="form-field-kota" name="kota" data-placeholder="Pilih Kota..">
													</select>
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Alamat </label>

												<div class="col-sm-4">
													<textarea name="alamat" id="form-field-alamat" class="autosize-transition form-control" style="overflow: hidden; overflow-wrap: break-word; resize: horizontal; height: 52px;" cols="40" rows="5"></textarea>
												</div>
											</div>
											

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Kode Pos </label>

                                                <div class="col-sm-9">
                                                    <input type="text" name="kode_pos" id="form-field-kode_pos" placeholder="" class="col-xs-10 col-sm-5" />
                                                </div>
                                            </div>

											<div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Status Bangunan </label>

                                                <div class="col-sm-9">            
													<select name="status_tempat" id="form-field-status">
														<option value="draft">Draft</option>
														<option value="publish">Publish</option>
													</select>
													<span class="help-button" data-rel="popover" data-trigger="hover" data-placement="right" data-html="true" data-content="Draft : Jika tidak ingin ditampilkan di aplikasi<hr>Publish : Jika ingin ditampilkan di aplikasi" title="Info Fitur">?</span>
                                                </div>
											</div>

                                            <div class="clearfix form-actions">
                                                <div class="col-md-offset-3 col-md-9">
                                                    <button class="btn btn-info" type="submit">
                                                        <i class="ace-icon fa fa-check bigger-110"></i>
                                                        Submit
                                                    </button>

                                                    &nbsp; &nbsp; &nbsp;
                                                    <button class="btn" type="reset">
                                                        <i class="ace-icon fa fa-undo bigger-110"></i>
                                                        Reset
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                
		<!-- page specific plugin scripts -->
		<script src="{{ asset('assets/js/jquery-ui.custom.min.js') }}"></script>
		<script src="{{ asset('assets/js/jquery.ui.touch-punch.min.js') }}"></script>
		<script src="{{ asset('assets/js/chosen.jquery.min.js') }}"></script>
		<script src="{{ asset('assets/js/spinbox.min.js') }}"></script>
		<script src="{{ asset('assets/js/bootstrap-datepicker.min.js') }}"></script>
		<script src="{{ asset('assets/js/bootstrap-timepicker.min.js') }}"></script>
		<script src="{{ asset('assets/js/moment.min.js') }}"></script>
		<script src="{{ asset('assets/js/daterangepicker.min.js') }}"></script>
		<script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
		<script src="{{ asset('assets/js/bootstrap-colorpicker.min.js') }}"></script>
		<script src="{{ asset('assets/js/jquery.knob.min.js') }}"></script>
		<script src="{{ asset('assets/js/autosize.min.js') }}"></script>
		<script src="{{ asset('assets/js/jquery.inputlimiter.min.js') }}"></script>
		<script src="{{ asset('assets/js/jquery.maskedinput.min.js') }}"></script>
		<script src="{{ asset('assets/js/bootstrap-tag.min.js') }}"></script>
		<script src="{{ asset('assets/js/markdown.min.js') }}"></script>
		<script src="{{ asset('assets/js/bootstrap-markdown.min.js') }}"></script>
		<script src="{{ asset('assets/js/jquery.hotkeys.index.min.js') }}"></script>
		<script src="{{ asset('assets/js/bootstrap-wysiwyg.min.js') }}"></script>
		<script src="{{ asset('assets/js/bootbox.js') }}"></script>
		
		<script src="{{ asset('assets/js/jquery.bootstrap-duallistbox.min.js') }}"></script>
		<script src="{{ asset('assets/js/jquery.raty.min.js') }}"></script>
		<script src="{{ asset('assets/js/bootstrap-multiselect.min.js') }}"></script>
		<script src="{{ asset('assets/js/select2.min.js') }}"></script>
		<script src="{{ asset('assets/js/jquery-typeahead.js') }}"></script>

		<script src="{{asset('assets/global/plugins/jquery-repeater/jquery.repeater.js')}}" type="text/javascript"></script>
		<script src="{{asset('assets/pages/scripts/form-repeater.js')}}" type="text/javascript"></script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
				$('#id-disable-check').on('click', function() {
					var inp = $('#form-input-readonly').get(0);
					if(inp.hasAttribute('disabled')) {
						inp.setAttribute('readonly' , 'true');
						inp.removeAttribute('disabled');
						inp.value="This text field is readonly!";
					}
					else {
						inp.setAttribute('disabled' , 'disabled');
						inp.removeAttribute('readonly');
						inp.value="This text field is disabled!";
					}
				});
			
			
				if(!ace.vars['touch']) {
					$('.chosen-select').chosen({allow_single_deselect:true}); 
					//resize the chosen on window resize
			
					$(window)
					.off('resize.chosen')
					.on('resize.chosen', function() {
						$('.chosen-select').each(function() {
							 var $this = $(this);
							 $this.next().css({'width': $this.parent().width()});
						})
					}).trigger('resize.chosen');
					//resize chosen on sidebar collapse/expand
					$(document).on('settings.ace.chosen', function(e, event_name, event_val) {
						if(event_name != 'sidebar_collapsed') return;
						$('.chosen-select').each(function() {
							 var $this = $(this);
							 $this.next().css({'width': $this.parent().width()});
						})
					});
			
			
					$('#chosen-multiple-style .btn').on('click', function(e){
						var target = $(this).find('input[type=radio]');
						var which = parseInt(target.val());
						if(which == 2) $('#form-field-select-4').addClass('tag-input-style');
						 else $('#form-field-select-4').removeClass('tag-input-style');
					});
				}
			
			
				$('[data-rel=tooltip]').tooltip({container:'body'});
				$('[data-rel=popover]').popover({container:'body'});
			
				autosize($('textarea[class*=autosize]'));
				
				$('textarea.limited').inputlimiter({
					remText: '%n character%s remaining...',
					limitText: 'max allowed : %n.'
				});
			
				$.mask.definitions['~']='[+-]';
				$('.input-mask-date').mask('99/99/9999');
				$('.input-mask-phone').mask('(999) 999-9999');
				$('.input-mask-eyescript').mask('~9.99 ~9.99 999');
				$(".input-mask-product").mask("a*-999-a999",{placeholder:" ",completed:function(){alert("You typed the following: "+this.val());}});
			
			
			
				$( "#input-size-slider" ).css('width','200px').slider({
					value:1,
					range: "min",
					min: 1,
					max: 8,
					step: 1,
					slide: function( event, ui ) {
						var sizing = ['', 'input-sm', 'input-lg', 'input-mini', 'input-small', 'input-medium', 'input-large', 'input-xlarge', 'input-xxlarge'];
						var val = parseInt(ui.value);
						$('#form-field-4').attr('class', sizing[val]).attr('placeholder', '.'+sizing[val]);
					}
				});
			
				$( "#input-span-slider" ).slider({
					value:1,
					range: "min",
					min: 1,
					max: 12,
					step: 1,
					slide: function( event, ui ) {
						var val = parseInt(ui.value);
						$('#form-field-5').attr('class', 'col-xs-'+val).val('.col-xs-'+val);
					}
				});
			
			
				
				//"jQuery UI Slider"
				//range slider tooltip example
				$( "#slider-range" ).css('height','200px').slider({
					orientation: "vertical",
					range: true,
					min: 0,
					max: 100,
					values: [ 17, 67 ],
					slide: function( event, ui ) {
						var val = ui.values[$(ui.handle).index()-1] + "";
			
						if( !ui.handle.firstChild ) {
							$("<div class='tooltip right in' style='display:none;left:16px;top:-6px;'><div class='tooltip-arrow'></div><div class='tooltip-inner'></div></div>")
							.prependTo(ui.handle);
						}
						$(ui.handle.firstChild).show().children().eq(1).text(val);
					}
				}).find('span.ui-slider-handle').on('blur', function(){
					$(this.firstChild).hide();
				});
				
				
				$( "#slider-range-max" ).slider({
					range: "max",
					min: 1,
					max: 10,
					value: 2
				});
				
				$( "#slider-eq > span" ).css({width:'90%', 'float':'left', margin:'15px'}).each(function() {
					// read initial values from markup and remove that
					var value = parseInt( $( this ).text(), 10 );
					$( this ).empty().slider({
						value: value,
						range: "min",
						animate: true
						
					});
				});
				
				$("#slider-eq > span.ui-slider-purple").slider('disable');//disable third item
			
				
				$('#id-input-file-1 , #id-input-file-2').ace_file_input({
					no_file:'No File ...',
					btn_choose:'Choose',
					btn_change:'Change',
					droppable:false,
					onchange:null,
					thumbnail:false //| true | large
					//whitelist:'gif|png|jpg|jpeg'
					//blacklist:'exe|php'
					//onchange:''
					//
				});
				//pre-show a file name, for example a previously selected file
				//$('#id-input-file-1').ace_file_input('show_file_list', ['myfile.txt'])
			
			
				$('#id-input-file-3').ace_file_input({
					style: 'well',
					btn_choose: 'Taruh file atau klik untuk upload gambar',
					btn_change: null,
					no_icon: 'ace-icon fa fa-picture-o',
					droppable: true,
					thumbnail: 'small'//large | fit
					//,icon_remove:null//set null, to hide remove/reset button
					/**,before_change:function(files, dropped) {
						//Check an example below
						//or examples/file-upload.html
						return true;
					}*/
					/**,before_remove : function() {
						return true;
					}*/
					,
					preview_error : function(filename, error_code) {
						//name of the file that failed
						//error_code values
						//1 = 'FILE_LOAD_FAILED',
						//2 = 'IMAGE_LOAD_FAILED',
						//3 = 'THUMBNAIL_FAILED'
						//alert(error_code);
					}
			
				}).on('change', function(){
					//console.log($(this).data('ace_input_files'));
					//console.log($(this).data('ace_input_method'));
				});
				
				
				//$('#id-input-file-3')
				//.ace_file_input('show_file_list', [
					//{type: 'image', name: 'name of image', path: 'http://path/to/image/for/preview'},
					//{type: 'file', name: 'hello.txt'}
				//]);
			
				$('#id-input-denah-3').ace_file_input({
					style: 'well',
					btn_choose: 'Taruh file atau klik untuk upload denah',
					btn_change: null,
					no_icon: 'ace-icon fa fa-picture-o',
					droppable: true,
					thumbnail: 'small'//large | fit
					//,icon_remove:null//set null, to hide remove/reset button
					/**,before_change:function(files, dropped) {
						//Check an example below
						//or examples/file-upload.html
						return true;
					}*/
					/**,before_remove : function() {
						return true;
					}*/
					,
					preview_error : function(filename, error_code) {
						//name of the file that failed
						//error_code values
						//1 = 'FILE_LOAD_FAILED',
						//2 = 'IMAGE_LOAD_FAILED',
						//3 = 'THUMBNAIL_FAILED'
						//alert(error_code);
					}
			
				}).on('change', function(){
					//console.log($(this).data('ace_input_files'));
					//console.log($(this).data('ace_input_method'));
				});
				
				
				//$('#id-input-file-3')
				//.ace_file_input('show_file_list', [
					//{type: 'image', name: 'name of image', path: 'http://path/to/image/for/preview'},
					//{type: 'file', name: 'hello.txt'}
				//]);
				
			
				//dynamically change allowed formats by changing allowExt && allowMime function
				$('#id-file-format').removeAttr('checked').on('change', function() {
					var whitelist_ext, whitelist_mime;
					var btn_choose
					var no_icon
					if(this.checked) {
						btn_choose = "Drop images here or click to choose";
						no_icon = "ace-icon fa fa-picture-o";
			
						whitelist_ext = ["jpeg", "jpg", "png", "gif" , "bmp"];
						whitelist_mime = ["image/jpg", "image/jpeg", "image/png", "image/gif", "image/bmp"];
					}
					else {
						btn_choose = "Taruh file atau klik untuk upload gambar";
						no_icon = "ace-icon fa fa-picture-o";
						
						whitelist_ext = null;//all extensions are acceptable
						whitelist_mime = null;//all mimes are acceptable
					}
					var file_input = $('#id-input-file-3');
					file_input
					.ace_file_input('update_settings',
					{
						'btn_choose': btn_choose,
						'no_icon': no_icon,
						'allowExt': whitelist_ext,
						'allowMime': whitelist_mime
					})
					file_input.ace_file_input('reset_input');
					
					file_input
					.off('file.error.ace')
					.on('file.error.ace', function(e, info) {
						//console.log(info.file_count);//number of selected files
						//console.log(info.invalid_count);//number of invalid files
						//console.log(info.error_list);//a list of errors in the following format
						
						//info.error_count['ext']
						//info.error_count['mime']
						//info.error_count['size']
						
						//info.error_list['ext']  = [list of file names with invalid extension]
						//info.error_list['mime'] = [list of file names with invalid mimetype]
						//info.error_list['size'] = [list of file names with invalid size]
						
						
						/**
						if( !info.dropped ) {
							//perhapse reset file field if files have been selected, and there are invalid files among them
							//when files are dropped, only valid files will be added to our file array
							e.preventDefault();//it will rest input
						}
						*/
						
						
						//if files have been selected (not dropped), you can choose to reset input
						//because browser keeps all selected files anyway and this cannot be changed
						//we can only reset file field to become empty again
						//on any case you still should check files with your server side script
						//because any arbitrary file can be uploaded by user and it's not safe to rely on browser-side measures
					});
					
					
					/**
					file_input
					.off('file.preview.ace')
					.on('file.preview.ace', function(e, info) {
						console.log(info.file.width);
						console.log(info.file.height);
						e.preventDefault();//to prevent preview
					});
					*/
				
				});
			
				$('.spinner1').ace_spinner({value:0,min:0,max:200,step:1, btn_up_class:'btn-info' , btn_down_class:'btn-info'})
				.closest('.ace-spinner')
				.on('changed.fu.spinbox', function(){
					//console.log($('#spinner1').val())
				}); 
				$('#spinner2').ace_spinner({value:0,min:0,max:10000,step:100, touch_spinner: true, icon_up:'ace-icon fa fa-caret-up bigger-110', icon_down:'ace-icon fa fa-caret-down bigger-110'});
				$('#spinner3').ace_spinner({value:0,min:-100,max:100,step:10, on_sides: true, icon_up:'ace-icon fa fa-plus bigger-110', icon_down:'ace-icon fa fa-minus bigger-110', btn_up_class:'btn-success' , btn_down_class:'btn-danger'});
				$('#spinner4').ace_spinner({value:0,min:-100,max:100,step:10, on_sides: true, icon_up:'ace-icon fa fa-plus', icon_down:'ace-icon fa fa-minus', btn_up_class:'btn-purple' , btn_down_class:'btn-purple'});
			
				//$('#spinner1').ace_spinner('disable').ace_spinner('value', 11);
				//or
				//$('#spinner1').closest('.ace-spinner').spinner('disable').spinner('enable').spinner('value', 11);//disable, enable or change value
				//$('#spinner1').closest('.ace-spinner').spinner('value', 0);//reset to 0
			
			
				//datepicker plugin
				//link
				$('.date-picker').datepicker({
					autoclose: true,
					todayHighlight: true
				})
				//show datepicker when clicking on the icon
				.next().on(ace.click_event, function(){
					$(this).prev().focus();
				});
			
				//or change it into a date range picker
				$('.input-daterange').datepicker({autoclose:true});
			
			
				//to translate the daterange picker, please copy the "examples/daterange-fr.js" contents here before initialization
				$('input[name=date-range-picker]').daterangepicker({
					'applyClass' : 'btn-sm btn-success',
					'cancelClass' : 'btn-sm btn-default',
					locale: {
						applyLabel: 'Apply',
						cancelLabel: 'Cancel',
					}
				})
				.prev().on(ace.click_event, function(){
					$(this).next().focus();
				});
			
			
				$('#timepicker1').timepicker({
					minuteStep: 1,
					showSeconds: true,
					showMeridian: false,
					disableFocus: true,
					icons: {
						up: 'fa fa-chevron-up',
						down: 'fa fa-chevron-down'
					}
				}).on('focus', function() {
					$('#timepicker1').timepicker('showWidget');
				}).next().on(ace.click_event, function(){
					$(this).prev().focus();
				});
				
				
			
				
				if(!ace.vars['old_ie']) $('#date-timepicker1').datetimepicker({
				 //format: 'MM/DD/YYYY h:mm:ss A',//use this option to display seconds
				 icons: {
					time: 'fa fa-clock-o',
					date: 'fa fa-calendar',
					up: 'fa fa-chevron-up',
					down: 'fa fa-chevron-down',
					previous: 'fa fa-chevron-left',
					next: 'fa fa-chevron-right',
					today: 'fa fa-arrows ',
					clear: 'fa fa-trash',
					close: 'fa fa-times'
				 }
				}).next().on(ace.click_event, function(){
					$(this).prev().focus();
				});
				
			
				$('#colorpicker1').colorpicker();
				//$('.colorpicker').last().css('z-index', 2000);//if colorpicker is inside a modal, its z-index should be higher than modal'safe
			
				$('#simple-colorpicker-1').ace_colorpicker();
				//$('#simple-colorpicker-1').ace_colorpicker('pick', 2);//select 2nd color
				//$('#simple-colorpicker-1').ace_colorpicker('pick', '#fbe983');//select #fbe983 color
				//var picker = $('#simple-colorpicker-1').data('ace_colorpicker')
				//picker.pick('red', true);//insert the color if it doesn't exist
			
			
				$(".knob").knob();
				
				
				var tag_input = $('#form-field-tags');
				try{
					tag_input.tag(
					  {
						placeholder:tag_input.attr('placeholder'),
						//enable typeahead by specifying the source array
						source: ace.vars['US_STATES'],//defined in ace.js >> ace.enable_search_ahead
						/**
						//or fetch data from database, fetch those that match "query"
						source: function(query, process) {
						  $.ajax({url: 'remote_source.php?q='+encodeURIComponent(query)})
						  .done(function(result_items){
							process(result_items);
						  });
						}
						*/
					  }
					)
			
					//programmatically add/remove a tag
					var $tag_obj = $('#form-field-tags').data('tag');
					$tag_obj.add('Programmatically Added');
					
					var index = $tag_obj.inValues('some tag');
					$tag_obj.remove(index);
				}
				catch(e) {
					//display a textarea for old IE, because it doesn't support this plugin or another one I tried!
					tag_input.after('<textarea id="'+tag_input.attr('id')+'" name="'+tag_input.attr('name')+'" rows="3">'+tag_input.val()+'</textarea>').remove();
					//autosize($('#form-field-tags'));
				}
				
				
				/////////
				$('#modal-form input[type=file]').ace_file_input({
					style:'well',
					btn_choose:'Drop files here or click to choose',
					btn_change:null,
					no_icon:'ace-icon fa fa-cloud-upload',
					droppable:true,
					thumbnail:'large'
				})
				
				//chosen plugin inside a modal will have a zero width because the select element is originally hidden
				//and its width cannot be determined.
				//so we set the width after modal is show
				$('#modal-form').on('shown.bs.modal', function () {
					if(!ace.vars['touch']) {
						$(this).find('.chosen-container').each(function(){
							$(this).find('a:first-child').css('width' , '210px');
							$(this).find('.chosen-drop').css('width' , '210px');
							$(this).find('.chosen-search input').css('width' , '200px');
						});
					}
				})
				/**
				//or you can activate the chosen plugin after modal is shown
				//this way select element becomes visible with dimensions and chosen works as expected
				$('#modal-form').on('shown', function () {
					$(this).find('.modal-chosen').chosen();
				})
				*/
			
				
				
				$(document).one('ajaxloadstart.page', function(e) {
					autosize.destroy('textarea[class*=autosize]')
					
					$('.limiterBox,.autosizejs').remove();
					$('.daterangepicker.dropdown-menu,.colorpicker.dropdown-menu,.bootstrap-datetimepicker-widget.dropdown-menu').remove();
				});
			
			});
		</script>
		<script type="text/javascript">
			jQuery(function($){
				
				$('textarea[data-provide="markdown"]').each(function(){
					var $this = $(this);

					if ($this.data('markdown')) {
					$this.data('markdown').showEditor();
					}
					else $this.markdown()
					
					$this.parent().find('.btn').addClass('btn-white');
				})
				
				
				
				function showErrorAlert (reason, detail) {
					var msg='';
					if (reason==='unsupported-file-type') { msg = "Unsupported format " +detail; }
					else {
						//console.log("error uploading file", reason, detail);
					}
					$('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>'+ 
					'<strong>File upload error</strong> '+msg+' </div>').prependTo('#alerts');
				}

				//$('#editor1').ace_wysiwyg();//this will create the default editor will all buttons

				//but we want to change a few buttons colors for the third style
				$('#editor1').ace_wysiwyg({
					toolbar:
					[
						'font',
						null,
						'fontSize',
						null,
						{name:'bold', className:'btn-info'},
						{name:'italic', className:'btn-info'},
						{name:'strikethrough', className:'btn-info'},
						{name:'underline', className:'btn-info'},
						null,
						{name:'insertunorderedlist', className:'btn-success'},
						{name:'insertorderedlist', className:'btn-success'},
						{name:'outdent', className:'btn-purple'},
						{name:'indent', className:'btn-purple'},
						null,
						{name:'justifyleft', className:'btn-primary'},
						{name:'justifycenter', className:'btn-primary'},
						{name:'justifyright', className:'btn-primary'},
						{name:'justifyfull', className:'btn-inverse'},
						null,
						{name:'createLink', className:'btn-pink'},
						{name:'unlink', className:'btn-pink'},
						null,
						'foreColor',
						null,
						{name:'undo', className:'btn-grey'},
						{name:'redo', className:'btn-grey'}
					],
					'wysiwyg': {
						fileUploadError: showErrorAlert
					}
				}).prev().addClass('wysiwyg-style2');

				
				/**
				//make the editor have all the available height
				$(window).on('resize.editor', function() {
					var offset = $('#editor1').parent().offset();
					var winHeight =  $(this).height();
					
					$('#editor1').css({'height':winHeight - offset.top - 10, 'max-height': 'none'});
				}).triggerHandler('resize.editor');
				*/
				

				$('#editor2').css({'height':'200px'}).ace_wysiwyg({
					toolbar_place: function(toolbar) {
						return $(this).closest('.widget-box')
							.find('.widget-header').prepend(toolbar)
							.find('.wysiwyg-toolbar').addClass('inline');
					},
					toolbar:
					[
						'bold',
						{name:'italic' , title:'Change Title!', icon: 'ace-icon fa fa-leaf'},
						'strikethrough',
						null,
						'insertunorderedlist',
						'insertorderedlist',
						null,
						'justifyleft',
						'justifycenter',
						'justifyright'
					],
					speech_button: false
				});
				
				


				$('[data-toggle="buttons"] .btn').on('click', function(e){
					var target = $(this).find('input[type=radio]');
					var which = parseInt(target.val());
					var toolbar = $('#editor1').prev().get(0);
					if(which >= 1 && which <= 4) {
						toolbar.className = toolbar.className.replace(/wysiwyg\-style(1|2)/g , '');
						if(which == 1) $(toolbar).addClass('wysiwyg-style1');
						else if(which == 2) $(toolbar).addClass('wysiwyg-style2');
						if(which == 4) {
							$(toolbar).find('.btn-group > .btn').addClass('btn-white btn-round');
						} else $(toolbar).find('.btn-group > .btn-white').removeClass('btn-white btn-round');
					}
				});


				

				//RESIZE IMAGE
				
				//Add Image Resize Functionality to Chrome and Safari
				//webkit browsers don't have image resize functionality when content is editable
				//so let's add something using jQuery UI resizable
				//another option would be opening a dialog for user to enter dimensions.
				if ( typeof jQuery.ui !== 'undefined' && ace.vars['webkit'] ) {
					
					var lastResizableImg = null;
					function destroyResizable() {
						if(lastResizableImg == null) return;
						lastResizableImg.resizable( "destroy" );
						lastResizableImg.removeData('resizable');
						lastResizableImg = null;
					}

					var enableImageResize = function() {
						$('.wysiwyg-editor')
						.on('mousedown', function(e) {
							var target = $(e.target);
							if( e.target instanceof HTMLImageElement ) {
								if( !target.data('resizable') ) {
									target.resizable({
										aspectRatio: e.target.width / e.target.height,
									});
									target.data('resizable', true);
									
									if( lastResizableImg != null ) {
										//disable previous resizable image
										lastResizableImg.resizable( "destroy" );
										lastResizableImg.removeData('resizable');
									}
									lastResizableImg = target;
								}
							}
						})
						.on('click', function(e) {
							if( lastResizableImg != null && !(e.target instanceof HTMLImageElement) ) {
								destroyResizable();
							}
						})
						.on('keydown', function() {
							destroyResizable();
						});
					}

					enableImageResize();

					/**
					//or we can load the jQuery UI dynamically only if needed
					if (typeof jQuery.ui !== 'undefined') enableImageResize();
					else {//load jQuery UI if not loaded
						//in Ace demo ./components will be replaced by correct components path
						$.getScript("assets/js/jquery-ui.custom.min.js", function(data, textStatus, jqxhr) {
							enableImageResize()
						});
					}
					*/
				}


			});
		</script>

		
		<script type="text/javascript">
			jQuery(function($){
			    var demo1 = $('select[name="duallistbox_demo1[]"]').bootstrapDualListbox({infoTextFiltered: '<span class="label label-purple label-lg">Filtered</span>'});
				var container1 = demo1.bootstrapDualListbox('getContainer');
				container1.find('.btn').addClass('btn-white btn-info btn-bold');
			
				/**var setRatingColors = function() {
					$(this).find('.star-on-png,.star-half-png').addClass('orange2').removeClass('grey');
					$(this).find('.star-off-png').removeClass('orange2').addClass('grey');
				}*/
				$('.rating').raty({
					'cancel' : true,
					'half': true,
					'starType' : 'i'
					/**,
					
					'click': function() {
						setRatingColors.call(this);
					},
					'mouseover': function() {
						setRatingColors.call(this);
					},
					'mouseout': function() {
						setRatingColors.call(this);
					}*/
				})//.find('i:not(.star-raty)').addClass('grey');
				
				
				
				//////////////////
				//select2
				$('.select2').css('width','200px').select2({allowClear:true})
				$('#select2-multiple-style .btn').on('click', function(e){
					var target = $(this).find('input[type=radio]');
					var which = parseInt(target.val());
					if(which == 2) $('.select2').addClass('tag-input-style');
					 else $('.select2').removeClass('tag-input-style');
				});
				
				//////////////////
				$('.multiselect').multiselect({
				 enableFiltering: true,
				 enableHTML: true,
				 buttonClass: 'btn btn-white btn-primary',
				 templates: {
					button: '<button type="button" class="multiselect dropdown-toggle" data-toggle="dropdown"><span class="multiselect-selected-text"></span> &nbsp;<b class="fa fa-caret-down"></b></button>',
					ul: '<ul class="multiselect-container dropdown-menu"></ul>',
					filter: '<li class="multiselect-item filter"><div class="input-group"><span class="input-group-addon"><i class="fa fa-search"></i></span><input class="form-control multiselect-search" type="text"></div></li>',
					filterClearBtn: '<span class="input-group-btn"><button class="btn btn-default btn-white btn-grey multiselect-clear-filter" type="button"><i class="fa fa-times-circle red2"></i></button></span>',
					li: '<li><a tabindex="0"><label></label></a></li>',
			        divider: '<li class="multiselect-item divider"></li>',
			        liGroup: '<li class="multiselect-item multiselect-group"><label></label></li>'
				 }
				});
			
				
				///////////////////
					
				//typeahead.js
				//example taken from plugin's page at: https://twitter.github.io/typeahead.js/examples/
				var substringMatcher = function(strs) {
					return function findMatches(q, cb) {
						var matches, substringRegex;
					 
						// an array that will be populated with substring matches
						matches = [];
					 
						// regex used to determine if a string contains the substring `q`
						substrRegex = new RegExp(q, 'i');
					 
						// iterate through the pool of strings and for any string that
						// contains the substring `q`, add it to the `matches` array
						$.each(strs, function(i, str) {
							if (substrRegex.test(str)) {
								// the typeahead jQuery plugin expects suggestions to a
								// JavaScript object, refer to typeahead docs for more info
								matches.push({ value: str });
							}
						});
			
						cb(matches);
					}
				 }
			
				 $('input.typeahead').typeahead({
					hint: true,
					highlight: true,
					minLength: 1
				 }, {
					name: 'states',
					displayKey: 'value',
					source: substringMatcher(ace.vars['US_STATES']),
					limit: 10
				 });
					
					
				///////////////
				
				//in ajax mode, remove remaining elements before leaving page
				$(document).one('ajaxloadstart.page', function(e) {
					$('[class*=select2]').remove();
					$('select[name="duallistbox_demo1[]"]').bootstrapDualListbox('destroy');
					$('.rating').raty('destroy');
					$('.multiselect').multiselect('destroy');
				});
			
			});
		</script>
		<script type="text/javascript">
			$(document).ready(function(){
				
				$('#form-field-provinsi').change(function(){
				
					//Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax
					var prov = $(this).val();
					
					$.ajax({
						type : 'GET',
						url : '{{url("api/kota")}}/'+prov,
						success: function (data) {
							
							//jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
							$("#form-field-kota").html(data);
							
							$('#form-field-kota').trigger("chosen:updated");
						}
					});
				});
			});
		</script>
@endsection