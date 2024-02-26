@if(session()->has('message'))
<div class="mb-3 w-full bg-blue-100 border-t border-b border-blue-500 rounded-md text-blue-700 px-4 py-3" role="alert">
    <p class="text-sm">{{session()->get('message')}}</p>
</div>
@elseif(session()->has('errors'))
<div class="mb-3 w-full bg-red-100 border-t border-b border-red-500 text-red-500 px-4 py-3" role="alert">
    @foreach ($errors->all() as $error)
    <p class="text-sm">{{ $error }}</p>
    @endforeach
</div>
@endif