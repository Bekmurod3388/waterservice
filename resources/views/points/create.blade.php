<button
    type="button"
    class="btn btn-secondary create-new btn-primary"
    data-bs-toggle="modal"
    data-bs-target="#basicModal">
    <span>
        <i class="bx bx-plus me-sm-1"></i>
        <span class="d-none d-sm-inline-block">Manzil qo'shish</span>
    </span>
</button>

<div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Manzil qo'shish</h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('client.points.store', request()->route('client')) }}">
                    @csrf
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="region_id" class="form-label">Tuman</label>
                            <select id="region_id" class="form-control" name="region_id">
                                @foreach($regions as $region)
                                    <option value="{{ $region->id }}">{{ $region->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="address" class="form-label">Manzil</label>
                            <input type="text" id="address" class="form-control" name="address" value="{{ old('address') }}"
                                   placeholder="Full Name" required/>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="filter_id" class="form-label">Filterlar</label>
                            <select id="filter_id" class="form-control" name="filter_id">
                                <option disabled>Mavjud emas</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="filter_expire" class="form-label">Almashtirish sanasi</label>
                            <input type="number" id="filter_expire" class="form-control" name="filter_expire" value="{{ old('expire') ?? 6 }}"
                                   required min="1" max="12"/>
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
