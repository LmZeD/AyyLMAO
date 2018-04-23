<div class="modal fade modal_view" id="modal_view">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Create new categoty</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 col-md-offset-2">
                        <form action="{{route('store')}}" method="post">
                            {{csrf_field()}}
                            <label for="title">Category title</label>
                            <input type="text" name="title">

                            <label for="parent_id">Category belongs to</label>
                            <select name="parent_id">
                                <option value={{null}}>None</option>
                                @foreach($allCategories as $category)
                                    <option value="{{$category->id}}">{{$category->title}}</option>
                                @endforeach
                            </select>

                            <button type="submit" class="btn btn-success">Create</button>
                        </form>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
