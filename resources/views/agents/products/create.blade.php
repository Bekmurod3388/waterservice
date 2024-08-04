<button
    type="button"
    class="btn btn-secondary create-new btn-primary"
    data-bs-toggle="modal"
    data-bs-target="#basicModal">
    <span>
        <i class="bx bx-plus me-sm-1"></i>
        <span class="d-none d-sm-inline-block"> Agent uchun mahsulot qo'shish </span>
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
                <form method="POST" action="{{ route('agent.products.store',[$agent->id]) }}">
                    @csrf
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="product" class="form-label">Mahsulot tanlang</label>
                            <select name="product_id" class="form-control" id="product">
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}">{{$product->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col mb-3">
                            <label for="quantity" class="form-label">Mahsulot soni</label>
                            <input type="number" min="0" class="form-control" name="quantity">
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
