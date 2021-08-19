@extends('app')

@section('content')

<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
	   <nav class="navbar navbar-light navbar-expand-lg mb-5" style="background-color: #e3f2fd;">
        <div class="container">
		 @include('navbars.navs')
		</div>
	   </nav>
        @if(session()->has('status'))
		  <div class="alert alert-success" role="alert">
		  {{ session()->get('status') }}
		  </div>
	     @endif	  
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Liste des comments</h4>
            <p class="card-category"></p>
          </div>
		 
          <div class="card-body">
		  
            <div class="table-responsive">
                <table class="table">
                <thead class=" text-primary">
                  <th>
                    ID
                  </th>
                  <th>
                    Comment
                  </th>
                  <th>
                    Status
                  </th>
				  <th>
                    Ticket Concerné
                  </th>
                  <th>
                    Author Name
                  </th>
				   <th>
                    Date création
                  </th>
				   <th>
                    Action
                  </th>
                </thead>
                <tbody>
                  <tr>
				  
				  @forelse($comments as $commentkey => $commentvalue)
                    <td>
					{{ $commentvalue->id }}
                    </td>
                    <td>
                      <a href="">{{ $commentvalue->comment }}</a>
                    </td>
                    <td>
					@if( $commentvalue->approved === 1 )
                      Approved
				    @else
					  Pending
				    @endif
                    </td>
					<td>
                      {{ $commentvalue->ticket_id }}
                    </td>
					<td>
                      {{ $commentvalue->author_name }}
                    </td>
                    <td class="text-primary">
                      {{ $commentvalue->created_at }}
                    </td>
					<td class="td-actions text-right"> 
                    @if($commentvalue->approved !== 1)					
					<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal1" data-bs-id="{{ $commentvalue->id }}"
					data-bs-comment="{{ $commentvalue->comment }}" data-bs-ticketid="{{ $commentvalue->ticket_id }}" data-bs-authorname="{{ $commentvalue->author_name }}" 
					data-bs-url="{{ route('comments.update', ['comment' => $commentvalue->id]) }}">
                    <span class="material-icons">
                            Approve
                    </span>
                    </button>
					@else 
						<span>------</span>
					@endif
<script type="text/javascript">
  jQuery(function() {
        jQuery('#exampleModal1').on('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var ticketId = button.getAttribute('data-bs-id');
            var ticketComment = button.getAttribute('data-bs-comment');
            var commenturl = button.getAttribute('data-bs-url');
			
            var modal = $(this);
            modal.find('#validcomment').attr("action", commenturl);
            jQuery('#cm_comment').attr("value", ticketComment);
        });
  });
    </script>

<!-- Modal -->
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Validate Comment</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Do you want really to validate this Comment?
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

<form id="validcomment" method="POST" action="">
		   @csrf
		   @method('PUT')
<div class="form-group">
          <input id="cm_comment" type="hidden" class="form-control" name="comment" value="">
      </div>
      <button type="submit" class="btn btn-block btn-primary">Approve</button>
  </form>
      </div>
    </div>
  </div>
</div>
                    </td>
                  </tr>
				  @empty
				  <tr><td>No available comments</td></tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
@endsection