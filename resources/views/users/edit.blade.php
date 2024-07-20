<button
    type="button"
    class="btn btn-warning me-2"
    data-bs-toggle="modal"
    data-bs-target="#editModal{{ $user->id }}"
>
    <i class="bx bx-edit-alt"></i>
</button>

<div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">User Edit</h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('users.update', $user->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="name" class="form-label">To'liq ism</label>
                            <input
                                class="form-control"
                                type="text"
                                id="name"
                                name="name"
                                value="{{ $user->name }}"
                            />
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label class="form-label" for="phone">Telefon raqami</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text">+99 8</span>
                                <input
                                    type="text"
                                    id="phone"
                                    name="phone"
                                    class="form-control"
                                    placeholder="912345678"
                                    value="{{ $user->phone }}"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-3 form-password-toggle">
                            <label class="form-label" for="password">Yangi Parol</label>
                            <div class="input-group input-group-merge">
                                <input
                                    type="password"
                                    class="form-control"
                                    id="password"
                                    name="password"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                />
                                <span id="password-toggle" class="input-group-text cursor-pointer">
                                    <i class="bx bx-hide"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-3 form-password-toggle">
                            <label class="form-label" for="password_confirmation">Parolni tasdiqlang</label>
                            <div class="input-group input-group-merge">
                                <input
                                    type="password"
                                    class="form-control"
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                />
                                <span id="password-confirmation-toggle" class="input-group-text cursor-pointer">
                                    <i class="bx bx-hide"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="roles" class="form-label">Rollar</label>
                            <div class="row">
                                @foreach($roles as $role)
                                    <div class="col-12 col-lg-3">
                                        <div class="form-check mt-3">
                                            <input class="form-check-input" type="checkbox" name="roles[]"
                                                   value="{{ $role->name }}" id="role{{ $role->id }}"
                                                   @if($user->hasRole($role->name)) checked @endif />
                                            <label class="form-check-label"
                                                   for="role{{ $role->id }}">{{ $role->name }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
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
