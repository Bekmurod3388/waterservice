<button
    type="button"
    class="btn btn-secondary create-new btn-primary"
    data-bs-toggle="modal"
    data-bs-target="#basicModal">
    <span>
        <i class="bx bx-plus me-sm-1"></i>
        <span class="d-none d-sm-inline-block"> Mahsulot yaratish </span>
    </span>
</button>

<div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">  Mahsulot yaratish </h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('products.store') }}">
                    @csrf
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label"> nomi</label>
                            <input type="text" id="nameBasic" class="form-control" name="name" value="{{ old('name') }}" required/>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="purchase_price" class="form-label">  narxi </label>
                            <input type="number" id="purchase_price" class="form-control" name="purchase_price"
                                   value="{{ old('purchase_price') }}" required/>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="quantity" class="form-label"> Soni </label>
                            <input type="number" id="quantity" class="form-control" name="quantity"
                                   value="{{ old('quantity') }}" required/>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="type" class="form-label"> turi </label>
                            <input type="text" id="type" class="form-control" name="type"
                                   value="{{ old('type') }}" required/>
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
