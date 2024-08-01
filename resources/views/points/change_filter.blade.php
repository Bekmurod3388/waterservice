<button
    type="button"
    class="btn btn-outline-danger"
    data-bs-toggle="modal"
    data-bs-target="#basicModal">
    {{$point->filter_expire_date->format('Y-m-d')}}
</button>

<div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Agent belgilash</h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>

            <div class="modal-body">
                <form method="POST" action="{{ route('work.list.store',$point->id) }}">

                    @csrf
                    @method('PUT')

                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="date" class="form-label">Sana belgilash</label><br>
                            <input type="date" name="filter_expire_date" id="date" class="form-control">
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="reason" class="form-label">Qo`shimcha malumot</label><br>
                            <input id="reason" name="reason" class="form-control" >
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Yopish</button>
                        <button type="submit" class="btn btn-primary">Saqlash</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
