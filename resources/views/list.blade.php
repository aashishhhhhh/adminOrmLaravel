
@foreach ($role as $rolevalue) 
 @if ($rolevalue->role=='admin')
<table class="table table-striped table-hover">
   
    <thead>
        <tr>
            <th>
                <span class="custom-checkbox">
                    <input type="checkbox" id="selectAll">
                    <label for="selectAll"></label>
                </span>
            </th>
            <th>Username</th>
            <th>Email</th>
            <th>Address</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
    </thead>
   

        @foreach ($datas as $item)

        <tbody>
            <tr>
                <td>
                    <span class="custom-checkbox">
                        <input type="checkbox" id="checkbox1" name="options[]" value="1">
                        <label for="checkbox1"></label>
                    </span>
                </td>
                <td>{{$item->username}}</td>
                <td>{{$item->email}}</td>
                <td>{{$item->address}}</td>
                <td>{{$item->role}}</td>    
                <td>
                    <a class="btn" data-toggle="modal" data-target="#editModal{{$item->id}}"  data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                    <a  class="btn" data-toggle="modal"  data-target="#deleteModal{{$item->id}}"> <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                    <a href="{{url('showPost/'.$item->id)}}" class="btn" > <i class="material-icons" data-toggle="tooltip">&#xe315;</i></a>
                </td>
            </tr>
    <!-- Modal -->
    <div class="modal fade" id="editModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
    
            <div class="modal-body">
                <form method="post" action="{{url('edit')}}">
                    @csrf
                    <div class="modal-header">						
                        <h4 class="modal-title">Edit User</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" name="id" class="form-control" value="{{$item->id}}" required>
                        </div>					
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="username" class="form-control" value="{{$item->username}}" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" value="{{$item->email}}" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" name="address" class="form-control" value="{{$item->address}}" required></textarea>
                        </div>				
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-info" value="Save">
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="GET" action="{{url('delete/'.$item->id)}}">
                    <div class="modal-header">						
                        <h4 class="modal-title">Delete User</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">					
                        <p>Are you sure you want to delete these Records?</p>
                        <p class="text-warning"><small>This action cannot be undone.</small></p>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-danger" value="Delete">
                    </div>
                </form>
            </div>
        </div>
        </div>
        </tbody>
        @endforeach

 
</table>
<div class="d-flex justify-content-center">
    {!! $datas->links() !!}
</div>
@else



<table class="table table-striped table-hover">
   
    <thead>
        <tr>
        
            <th>Title</th>
            <th>Content</th>
            <th>Image</th>

         
        </tr>
    </thead>
    @foreach ($posts as $item)

       <tbody>
           <tr>
               <td>{{$item->title}}</td>
               <td>{{$item->content}}</td>
               <td><img id="pImg" src="{{ asset('images/'.$item->photo) }}" alt="" /></td>
             
           </tr>
   <!-- Modal -->

       </tbody>
       @endforeach



@endif
@endforeach
    {{-- Pagination --}}
 