<button
    type="button"
    class="btn btn-warning me-2"
    data-bs-toggle="modal"
    data-bs-target="#editModal{{ $client->id }}"
>
    <i class="bx bx-edit-alt"></i>
</button>

<div class="modal fade" id="editModal{{ $client->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Mijozni taxrirlash</h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('clients.update', $client->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label">To'liq ismi</label>
                            <input type="text" id="nameBasic" class="form-control" name="name" value="{{ $client->name }}" required/>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="phone" class="form-label">Telefon raqami</label>

                            <div class="input-group input-group-merge">
                                <span class="input-group-text">+99 8</span>
                                <input
                                    type="tel"
                                    id="phone"
                                    name="phone"
                                    pattern="[0-9]{9}"
                                    maxlength="9"
                                    class="form-control"
                                    placeholder="912345678"
                                    value="{{ $client->phone }}"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="exampleFormControlSelect1" class="form-label">Operator Dilleri</label>
                            <select id="exampleFormControlSelect1" class="form-control" name="operator_dealer_id" aria-label="Default select example" required>
                                <option disabled>Operator Dillerini tanlang</option>
                                @foreach($operators as $operator)
                                    <option value="{{ $operator->id }}" {{ $client->operator_dealer_id == $operator->id ? 'selected' : '' }}>
                                        {{ $operator->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="telegramId" class="form-label">Telegram</label>
                            <input type="number" id="telegramId" class="form-control" name="telegram_id" value="{{ $client->telegram_id }}"/>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="description" class="form-label">Tavsif</label>
                            <textarea id="description" class="form-control" name="description">{{ $client->description }}</textarea>
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
