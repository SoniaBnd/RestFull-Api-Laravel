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
            <h4 class="card-title ">Liste des tickets</h4>
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
                    Titre
                  </th>
                  <th>
                    Status
                  </th>
                  <th>
                    Description
                  </th>
                 <!-- <th>
                    Projet Attaché
                  </th>-->
				   <th>
                    Date création
                  </th>
				   <th>
                    Action
                  </th>
                </thead>
                <tbody>
                  <tr>
				  
				  @forelse($tickets as $ticketkey => $ticketvalue)
                    <td>
					{{ $ticketvalue->id }}
                    </td>
                    <td>
                      <a href="">{{ $ticketvalue->title }}</a>
                    </td>
                    <td>
                      {{ $ticketvalue->status }}
                    </td>
					<td>
                      {{ $ticketvalue->description }}
                    </td>
                  
                    <td class="text-primary">
                      {{ $ticketvalue->created_at }}
                    </td>
					<td class="td-actions text-right"> 
                    @if($ticketvalue->status !== 'Publish')					
					<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal1" data-bs-id="{{ $ticketvalue->id }}"
					data-bs-title="{{ $ticketvalue->title }}" data-bs-description="{{ $ticketvalue->description }}" data-bs-url="{{ route('tickets.update', ['ticket' => $ticketvalue->id]) }}">
                    <span class="material-icons">
                            Validate
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
            var ticketTitle = button.getAttribute('data-bs-title');
            var ticketDescription = button.getAttribute('data-bs-description');
            
            var ticketurl = button.getAttribute('data-bs-url');
			
            var modal = $(this);
            modal.find('#validticket').attr("action", ticketurl);
            jQuery('#tk_title').attr("value", ticketTitle);
            jQuery('#tk_description').attr("value", ticketDescription);
        });
  });
    </script>

<!-- Modal -->
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Validate Ticket</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Do you want really to validate this Ticket?
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

<form id="validticket" method="POST" action="">
		   @csrf
		   @method('PUT')
<div class="form-group">
          <input id="tk_title" type="hidden" class="form-control" name="title" value="">
      </div>
      <div class="form-group">
          <input type="hidden" id="tk_description"  class="form-control" name="description" value="" />
		  <input type="hidden" id=""  class="form-control" name="status" value="Publish" />
      </div>
      <button type="submit" class="btn btn-block btn-primary">Validate</button>
  </form>
      </div>
    </div>
  </div>
</div>
                    </td>
                  </tr>
				  @empty
				  <tr><td>No tickets Yet</td></tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
@endsection