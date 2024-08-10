<button
    type="button"
    class="btn btn-warning me-2"
    data-bs-toggle="modal"
    data-bs-target="#editModal{{ $point->id }}"
>
    <i class="bx bx-edit-alt"></i>
</button>

<div class="modal fade" id="editModal{{ $point->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Client Edit</h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                <form method="POST"
                      action="{{ route('client.points.update', [request()->route('client'), $point->id]) }}">
                    @csrf
                    @method('PUT')
                    <div class="col mb-3">
                        <label for="region_id" class="form-label">Tuman</label>
                        <select id="region_id" class="form-control" name="region_id">
                            @foreach($regions as $region)
                                <option
                                    @selected($region->id == $point->region_id) value="{{ $region->id }}">{{ $region->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="address" class="form-label">Manzil</label>
                            <input type="text" id="address" class="form-control" name="address"
                                   value="{{ $point->address }}"
                                   placeholder="Manzil" required/>
                        </div>
                    </div>
                    @role('operator_dealer')
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="filter_id" class="form-label">Dillerni tanlang</label>
                            <select id="filter_id" class="form-control" name="filter_id">
                                <option disabled>Mavjud emas</option>
                                @foreach($dealers as $id => $dealer)
                                    <option value="{{ $id }}">{{ $dealer }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="comment" class="form-label">Izoh</label>
                            <input type="text" id="comment" class="form-control" name="comment"
                                   value="{{ $point->comment }}"
                                   placeholder="Izoh"/>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="demo_time" class="form-label">Uchrashuv vaqti</label>
                            <input type="datetime-local" id="demo_time" class="form-control" name="demo_time"
                                   value="{{ $point->demo_time }}"
                                   placeholder="Demo time"/>
                        </div>
                    </div>
                    @else
                        <div class="row g-2">
                            <div class="col mb-3">
                                <label for="filter_id" class="form-label">Filterlar</label>
                                <select id="filter_id" class="form-control" name="filter_id">
                                    <option disabled>Mavjud emas</option>
                                    @foreach($products as $product)
                                        <option
                                            @selected($product->id == $point->filter_id) value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row g-2">
                            <div class="col mb-3">
                                <label for="filter_expire" class="form-label">Almashtirish sanasi</label>
                                <input type="number" id="filter_expire" class="form-control" name="filter_expire"
                                       value="{{ $point->filter_expire }}"
                                       required min="1" max="12"/>
                            </div>
                        </div>



{{--                        <div class="row g-2">--}}
{{--                            <div class="col mb-3">--}}
{{--                                <label for="filter_expire" class="form-label">filter_expire_date</label>--}}
{{--                                <input type="date" id="filter_expire" class="form-control" name="filter_expire_date"--}}
{{--                                       value="{{ $product->filter_expire_date }}"--}}
{{--                                       required min="1" max="12"/>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="row g-2">--}}
{{--                            <div class="col mb-3">--}}
{{--                                <label for="filter_expire" class="form-label"> contract_date </label>--}}
{{--                                <input type="date" id="filter_expire" class="form-control" name="contract_date"--}}
{{--                                       value="{{ $product->contract_date}}"--}}
{{--                                       required min="1" max="12"/>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="row g-2">--}}
{{--                            <div class="col mb-3">--}}
{{--                                <label for="filter_expire" class="form-label"> installation_date </label>--}}
{{--                                <input type="date" id="filter_expire" class="form-control" name="installation_date"--}}
{{--                                       value="{{  $product-> installation_date}}"--}}
{{--                                       required min="1" max="12"/>--}}
{{--                            </div>--}}
{{--                        </div>--}}


                        @endrole
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Yopish
                            </button>
                            <button type="submit" class="btn btn-primary">Saqlash</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
