<button
    type="button"
    class="btn btn-secondary create-new btn-primary"
    data-bs-toggle="modal"
    data-bs-target="#basicModal">
    <span>
        <i class="bx bx-plus me-sm-1"></i>
        <span class="d-none d-sm-inline-block">Yangi mijoz qo'shish</span>
    </span>
</button>

<div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Yangi mijoz qo'shish</h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('user.store') }}">
                    @csrf
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label">To'liq ismi</label>
                            <input type="text" id="nameBasic" class="form-control" name="name" value="{{ old('name') }}" placeholder="Full Name" required/>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="phone" class="form-label">Telefon raqami</label>
                            <input type="tel" id="phone" class="form-control" name="phone" placeholder="940810048"
                                   pattern="[0-9]{9}" maxlength="9" value="{{ old('phone') }}" required/>
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
