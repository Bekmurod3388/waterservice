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
                <form method="POST" action="{{ route('clients.store') }}">
                    @csrf
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label">To'liq ismi</label>
                            <input type="text" id="nameBasic" class="form-control" name="name" value="{{ old('name') }}" required/>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="phone" class="form-label">Telefon raqami</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text">+998</span>
                                <input type="tel" id="phone" class="form-control" name="phone"
                                       pattern="[0-9]{9}" maxlength="9" value="{{ old('phone') }}" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="telegramId" class="form-label">Telegram ID (<a href="https://t.me/myidbot" target="_blank">@myidbot</a>)</label>
                            <input type="number" id="telegramId" class="form-control" name="telegram_id" value="{{ old('telegram_id') }}"/>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="description" class="form-label">Tavsif</label>
                            <textarea id="description" class="form-control" name="description">{{ old('description') }}</textarea>
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
