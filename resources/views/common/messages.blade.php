<script>
		
	window.onload = function(){
	    @if ($errors->any())
	        @foreach ($errors->all() as $error)
	        	M.toast({html:  '{{ $error }}' })
	        @endforeach
	    
	    @endif
        @if(isset($resultBusqueda))
            M.toast({html:  '{{$resultBusqueda['mensaje']}}' })
        @endif
        @if(session('messages'))
            @foreach(session('messages') as $messages)
                M.toast({html:  '{{$messages}}' })                
            @endforeach

        @endif
	}


</script>