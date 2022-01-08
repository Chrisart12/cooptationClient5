<div style="padding:15px;">
	<b>Utilisateur : </b><br />
	@if($user != null)
		Id : {{ $user->id }}<br />
		Prénom : {{ $user->first_name }}<br />
		Nom : {{ $user->last_name }}<br />
		Email : {{ $user->mail }}<br />
	@else
		Inconnu
	@endif
</div>

<div style="padding:15px;">
	<b>Url : </b><br />
	{{ $url }}
</div>

{{-- <div style="padding:15px;">
	<b>Exception : </b>
	<br />
	Message : {{ $exception->getMessage() }}
	<br />
	Code : {{ $exception->getCode() }}
	<br />
	File : {{ $exception->getFile() }}
	<br />
	Line : {{ $exception->getLine() }}
</div> --}}

{{-- <div style="padding:15px;">
	<b>StackTrace :  </b>
	<br />
	<table border='1'>
		<tr>
			<td style="align:center;font-weight:bold;">FUNCTION</td>
			<td style="align:center;font-weight:bold;">FILE</td>
			<td style="align:center;font-weight:bold;">LINE</td>
		</tr>
		@foreach($exception->getTrace() as $trace)
			<tr>
				<td>
					@if(isset($trace['function']))
						{{ $trace['function'] }}
					@endif
				</td>
				<td>
					@if(isset($trace['file']))
						{{ $trace['file'] }}
					@endif
				</td>
				<td>
					@if(isset($trace['line']))
						{{ $trace['line'] }}
					@endif
				</td>
			</tr>
		@endforeach
	</table>
</div> --}}