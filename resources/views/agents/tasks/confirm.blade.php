<button
    type="button"
    class="btn btn-success create-new"
    data-bs-toggle="modal"
    data-bs-target="#basicModal">
    <span>
        <i class="bx bx-plus me-sm-1"></i>
        <span class="d-none d-sm-inline-block"> Tasdiqlash </span>
    </span>
</button>

<div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">  Haqiqatdan ham xizmatini tasdiqlamoqchimisiz? </h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>

            <div class="modal-body">
                <form method="POST" action="{{ route('agent.tasks.confirm',[$task->agent_id, $task->id]) }}">
                    @csrf
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">YO'Q</button>
                        <button type="submit" class="btn btn-success">HA</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
