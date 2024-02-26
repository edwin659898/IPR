<div>
  @foreach($images as $image)
  <div>
    <a href="{{route('todo.file',$image->id)}}" target="_blank" class="mr-2">{{$image->image}}</a>
    <a class="text-danger" onclick="return confirm('Are you sure?')" href="{{route('file.delete',$image->id)}}">
      <i class="fa fa-trash"></i>
    </a>
  </div>
  @endforeach
</div>