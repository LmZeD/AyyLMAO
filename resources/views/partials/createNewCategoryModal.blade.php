<div class="modal fade modal_view" id="modal_view">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Create new categoty</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-md-offset-4">
                        <div class="form-control">
                            <form action="{{route('store')}}" method="post">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="title">Category title</label>
                                    <input type="text" name="title">
                                </div>
                                <div class="form-group">
                                    <label for="parent_id">Category belongs to</label>
                                    <select name="parent_id">
                                        <option value={{null}}>None</option>
                                        @foreach($allCategories as $category)
                                            <option value="{{$category->id}}">{{$category->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <button type="submit" class="btn btn-success">Create</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
