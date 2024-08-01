<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $product->id }}">
    <i class="bx bx-trash-alt"></i>
</button>

<div class="modal fade" id="deleteModal{{ $product->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel{{ $product->id }}">Siz uni qaytarib ololmaysiz!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ $product->name }}ni o'chirmoqchimisiz?
            </div>
            <div class="modal-footer">
                <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Oʻchirish</button>
                </form>
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Yopishe</button>
            </div>
        </div>
    </div>
</div>
