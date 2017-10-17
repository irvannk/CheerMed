@extends('layouts.app')

@section('content')
<a href="email" class="btn btn-success" onclick="return confirm(\"daw\")">Kirim Email</a><br><br>
<div class="col-md-9">
	<div class="card">
		<div class="header">
			Postingan
		</div>
		<div class="body">
            <div class="row clearfix">
                <div class="col-sm-12">
                    <div class="form-group">
	                    <form action="send" method="POST" enctype="multipart/form-data">
	                        <div class="form-line">
	                            <textarea type="text" name="message" rows="3" class="form-control no-resize" placeholder="Apa yang sedang anda pkirkan ...?"></textarea>
								<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
	                        </div><br>
	                        <div class="col-md-3">
		                        <div class="form-line">
		                        	<input type="file" class="form-control" name="photo">
		                        </div>
	                        </div>
	                        <div class="col-md-12">
			                    <button class="btn bg-teal waves-effect btn-md">
			                        <span><font size="3">Kirim</font></span>
			                        <i class="material-icons">send</i>
			                    </button>
		                    </div>
		                    {{ csrf_field() }}
						</form>
                	</div>
        		</div>
			</div>
		</div>
	</div>
</div>

@foreach($post as $posting)
<div class="col-md-9">
	<div class="card">
		<div class="header">

		@if( $posting->user->name == Auth::user()->name )
			<a href="batal/{{ $posting->id }}">Hapus Postingan</a>
		@else
			<a href="delete-posting/{{ $posting->id }}">Tampilkan Pop Up</a>
		@endif
		</div>
		<div class="body">
            <div class="row clearfix">
                <div class="col-md-12">
					<img src="{{ asset('img/'.$posting->user->picture) }}" width="50px" height="50px">
					<b>	{{ $posting->user->name }} </b>
						<div style="float: right">{{ $posting->created_at }} </div><br /><br />
						{{ $posting->posting }} <br /><br />
						@if($posting->photo != NULL)
							<div class="col-md-11">
								<img src="{{ asset('img/'.$posting->photo) }}" width="590px">
							</div>
						@else
						@endif
					<br /><br />
					<form action="comment" method="POST">
						<div class="col-md-7">
							<input type="text" name="comment" class="form-control">
							<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
							<input type="hidden" name="posting_id" value="{{ $posting->id }}">
							{{ csrf_field() }}
							<input type="submit" class="btn btn-warning btn-sm" value="Balas">
						</div>
					</form>
					<a id="comment">Hide Comment</a>
					<br /><br />
					<br /><br />
					<hr>
					<div style="margin-left: 40px;">
					@foreach($posting->comment as $comment)
						@if( $comment->user->name == Auth::user()->name )
							<a href="cancel_comment/{{ $comment->id }}">Batalkan Komentar</a><br>
						@else
						@endif
						<img src="{{ asset('img/'.$comment->user->picture) }}" width="30px" height="30px">
						<b>{{ $comment->user->name }}</b>
						{{ $comment->created_at }}<br>
						{{ $comment->comment }}<br><br>
					@endforeach
					</div>
                </div>
            </div>
        </div>
	</div>
</div>
@endforeach

<form action="upload" method="POST" enctype="multipart/form-data">
<input type="file" name="picture" class="form-control">
<input type="hidden" name="user_session" value="{{ Auth::user()->id }}">
<input type="submit" class="btn btn-danger btn-xs">
{{ csrf_field() }}
</form>
</div>

<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="js/jquery-1.12.1.min.js"></script>
<script type="text/javascript" src="js/test.js"></script>
<script type="text/javascript" src="js/scroll-finish.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#comment').click(function(){
			$('#commentz').slideToggle(500);
	});
</script>

@endsection