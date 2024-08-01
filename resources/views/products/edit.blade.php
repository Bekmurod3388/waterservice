<button
    type="button"
    class="btn btn-warning me-2"
    data-bs-toggle="modal"
    data-bs-target="#editModal{{ $product->id }}"
>
    <i class="bx bx-edit-alt"></i>
</button>

<div class="modal fade" id="editModal{{ $product->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Mohsulotni taxrirlash</h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('products.update', $product->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label">Mohsulot nomi</label>
                            <input type="text" id="nameBasic" class="form-control" name="name" value="{{ $product->name }}"/>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="purchase_price" class="form-label">Mohsulot narxi</label>
                            <input type="number" id="purchase_price" class="form-control" name="purchase_price" value="{{ $product->purchase_price }}" />
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="quantity" class="form-label">Mohsulot soni</label>
                            <input type="number" id="quantity" class="form-control" name="quantity" />
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="type" class="form-label">Mohsulot turi</label>
                            <input type="text" id="type" class="form-control" name="type" value="{{ $product->type }}" />
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
