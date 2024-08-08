<button
    type="button"
    class="btn btn-warning me-2"
    data-bs-toggle="modal"
    data-bs-target="#editModal{{ $val->id }}"
>
    <i class="bx bx-edit-alt"></i>
</button>

<div class="modal fade" id="editModal{{ $val->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Foydalanuvchini taxrirlash</h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('responsible.update', $val->id) }}">
                    @csrf
                    @method('PUT')


                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="operator_id" class="form-label">Operatorni tanlang</label><br>
                            <select id="operator_id" class="form-control" name="operator_id" required>
                                @foreach($operators as $operator)
                                    <option value="{{ $operator->id }}" {{ $val->operator_id == $operator->id ? 'selected' : '' }}>
                                        {{ $operator->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="cashier_id" class="form-label">Kassirni tanlang</label><br>
                            <select id="cashier_id" class="form-control" name="cashier_id" required>
                                @foreach($cashiers as $cashier)
                                    <option value="{{ $cashier->id }}" {{ $val->cashier_id == $cashier->id ? 'selected' : '' }}>
                                        {{ $cashier->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="month" class="form-label">  Oyi </label>
                            <input type="month" id="month" class="form-control" name="month"
                                   value="{{$val->month}}" required/>
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
